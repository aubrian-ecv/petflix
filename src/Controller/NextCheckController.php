<?php

namespace App\Controller;

use App\Repository\PetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NextCheckController extends AbstractController
{
    #[Route('/next-checks', name: 'app_next_check')]
    public function index(PetRepository $petRepository): Response
    {
        $petsWithUpcomingControls = $petRepository->findPetsWithUpcomingControls();
        
        $adoptersWithPets = [];

        foreach ($petsWithUpcomingControls as $pet) {
            $adopterId = $pet->getAdopter()->getId();
            $controlDate = $pet->getControlDate()->format('Y-m-d');

            // Initialise the adopter array if not already set
            if (!isset($adoptersWithPets[$adopterId])) {
                $adoptersWithPets[$adopterId] = [
                    'adopter' => $pet->getAdopter(),
                    'control_dates' => []
                ];
            }

            // Append the pet to the adopter's list of pets for the control date
            $adoptersWithPets[$adopterId]['control_dates'][$controlDate][] = $pet;
        }

        return $this->render('next_check/index.html.twig', [
            'controller_name' => 'NextCheckController',
            'controls' => $adoptersWithPets
        ]);
    }
}
