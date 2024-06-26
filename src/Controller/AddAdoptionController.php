<?php

namespace App\Controller;

use App\Entity\Adopter;
use App\Entity\Pet;
use App\Repository\PetRepository;
use DateInterval;
use DateTime;
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
            ->add('date')
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            if (count($data['pets']) == 0) {
                $this->addFlash('error', 'Vous devez sélectionner au moins un animal');
                return $this->redirectToRoute('app_add_adoption');
            }

            $adopter = new Adopter();
            $adopter->setName($data['name']);
            $adopter->setFirstName($data['firstName']);
            $adopter->setAddress($data['address']);
            $adopter->setEmail($data['email']);

            $em->persist($adopter);

            foreach ($data['pets'] as $pet) {
                $pet->setAdopter($adopter);
                $pet->setAdoptionDate(new DateTime($data['date']));
                $controlDate = (new DateTime($data['date']))->add(new DateInterval("P6M"));
                $pet->setControlDate($controlDate);
                $pet->setTotalCost($pet->getType()->getCost() + 10);
            }

            $em->flush();

            $this->addFlash('success', "L'adoption a bien été enregistrée");
            return $this->redirectToRoute('app_add_adoption');
        }

        return $this->render('add_adoption/index.html.twig', [
            'controller_name' => 'AddAdoptionController',
            'form' => $form,
            'pets' => $petRepository->findBy(["adopter" => null])
        ]);
    }
}
