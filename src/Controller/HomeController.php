<?php

namespace App\Controller;

use App\Repository\MemberRepository;
use App\Repository\PetTypeRepository;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', methods:['GET'], name: 'app_home')]
    public function index(VideoRepository $videoRepository, PetTypeRepository $petTypeRepository, MemberRepository $memberRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'videos' => $videoRepository->findAll(),
            'types' => $petTypeRepository->findAll(),
            'cities' => $memberRepository->findCities()
        ]);
    }

    #[Route('/', methods: ['POST'], name: 'app_search')]
    public function search(Request $req, VideoRepository $videoRepository): Response
    {
        $parameters = json_decode($req->getContent(), true);

        if (count($parameters['petTypes']) == 0 && count($parameters['cities']) == 0) {
            $resultsHtml = $this->renderView('home/_video.html.twig', [
                'videos' => $videoRepository->findAll()
            ]);
            return $this->json(["results" => $resultsHtml], Response::HTTP_OK, [], ['groups' => 'video']);
        }

        $videos = $videoRepository->findAll();

        $filteredVideos = [];

        foreach ($videos as $video) {
            // If parameter petTypes is not empty and parameter cities is empty, filter by petTypes
            if (count($parameters['petTypes']) > 0 && count($parameters['cities']) == 0) {
                foreach ($parameters['petTypes'] as $petType) {
                    if ($video->getPets()->exists(fn($key, $pet) => $pet->getType()->getId() == $petType))
                        $filteredVideos[] = $video;
                }
            }
            
            // If parameter petTypes is empty and parameter cities is not empty, filter by cities
            if (count($parameters['petTypes']) == 0 && count($parameters['cities']) > 0) {
                if (in_array($video->getMember()->getCity(), $parameters['cities']))
                    $filteredVideos[] = $video;
            }

            // If parameter petTypes and cities are not empty, filter by petTypes and cities
            if (count($parameters['petTypes']) > 0 && count($parameters['cities']) > 0) {
                foreach ($parameters['petTypes'] as $petType) {
                    if ($video->getPets()->exists(fn($key, $pet) => $pet->getType()->getId() == $petType) && in_array($video->getMember()->getCity(), $parameters['cities']))
                        $filteredVideos[] = $video;
                }
            }
        }

        $resultsHtml = $this->renderView('home/_video.html.twig', [
            'videos' => $filteredVideos
        ]);

        return $this->json(['results' => $resultsHtml], Response::HTTP_OK, [], ['groups' => 'video']);
    }
}