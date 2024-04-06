<?php

namespace App\Controller;

use App\Entity\Video;
use App\Form\AddVideoType;
use App\Repository\PetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddVideoController extends AbstractController
{
    #[Route('/create/video', name: 'app_add_video')]
    public function index(Request $request, EntityManagerInterface $em, PetRepository $petRepository): Response
    {

        $video = new Video();
        $video->setAddDate(new \DateTime('now'));
        $form = $this->createForm(AddVideoType::class, $video);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $video = $form->getData();

            if (count($video->getPets()) == 0) {
                $this->addFlash('error', 'Vous devez sélectionner au moins un animal');
                return $this->redirectToRoute('app_add_video');
            }

            // Check if $video->getUrl() is like "https://www.youtube.com/watch?v=video_id"
            if (preg_match('/^https:\/\/www\.youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $video->getUrl(), $matches)) {
                $video->setUrl("https://www.youtube.com/embed/" . $matches[1]);
            } else {
                // Check if $video->getUrl() is like "https://www.youtube.com/embed/video_id"
                if (!preg_match('/^https:\/\/www\.youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $video->getUrl(), $matches)) {
                    $this->addFlash('error', 'L\'URL de la vidéo n\'est pas valide');
                    return $this->redirectToRoute('app_add_video');
                }
            }

            foreach ($video->getPets() as $pet) {
                $pet->setVideo($video);
            }

            $em->persist($video);
            $em->flush();

            return $this->redirectToRoute('app_video_page', ['id' => $video->getId()]);
        }

        return $this->render('add_video/index.html.twig', [
            'controller_name' => 'AddVideoController',
            'form' => $form,
            'pets' => $petRepository->findBy(["video" => null])
        ]);
    }
}
