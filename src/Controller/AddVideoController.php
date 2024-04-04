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
