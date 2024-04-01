<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NextCheckController extends AbstractController
{
    #[Route('/next-checks', name: 'app_next_check')]
    public function index(): Response
    {
        return $this->render('next_check/index.html.twig', [
            'controller_name' => 'NextCheckController',
        ]);
    }
}
