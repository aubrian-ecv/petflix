<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VideoPageController extends AbstractController
{
    #[Route('/video', name: 'app_video_page')]
    public function index(): Response
    {
        return $this->render('video_page/index.html.twig', [
            'controller_name' => 'VideoPageController',
        ]);
    }
}
