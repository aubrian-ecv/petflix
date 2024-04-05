<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VideoPageController extends AbstractController
{
    #[Route('/{id}', name: 'app_video_page')]
    public function index(int $id, VideoRepository $videoRepository): Response
    {
        $video = $videoRepository->find($id);

        if (!$video) {
            throw $this->createNotFoundException('The video does not exist');
        }
        

        return $this->render('video_page/index.html.twig', [
            'controller_name' => 'VideoPageController',
            'video' => $video
        ]);
    }
}
