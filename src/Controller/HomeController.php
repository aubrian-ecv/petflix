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

        if (count($parameters['petTypes']) == 0 && count($parameters['cities']) == 0)
            return $this->json($videoRepository->findAll());

        $videos = $videoRepository->findAll();

        $filteredVideos = [];

        foreach ($videos as $video) {
            
        }

        return $this->json($filteredVideos);
    }
}
