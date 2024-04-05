<?php

namespace App\Controller;

use App\Entity\Adopter;
use App\Entity\Pet;
use App\Repository\PetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddAdoptionController extends AbstractController
{
    #[Route('/create/adoption', name: 'app_add_adoption')]
    public function index(Request $request,  EntityManagerInterface $em, PetRepository $petRepository): Response
    {

        $adopter = [];
        $form = $this->createFormBuilder($adopter)
            ->add('name')
            ->add('firstName')
            ->add('address')
            ->add('email')
            ->add('pets', EntityType::class, [
                'class' => Pet::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('date', DateType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $adopter = new Adopter();
            $adopter->setName($data['name']);
            $adopter->setFirstName($data['firstName']);
            $adopter->setAddress($data['address']);
            $adopter->setEmail($data['email']);

            $em->persist($adopter);

            foreach ($data['pets'] as $pet) {
                $pet->setAdopter($adopter);
                $pet->setAdoptionDate($data['date']);
            }

            $em->flush();

            $this->addFlash('success', "gg");
            return $this->redirectToRoute('app_add_adoption');
        }

        return $this->render('add_adoption/index.html.twig', [
            'controller_name' => 'AddAdoptionController',
            'form' => $form,
            'pets' => $petRepository->findBy(["adopter" => null])
        ]);
    }
}
