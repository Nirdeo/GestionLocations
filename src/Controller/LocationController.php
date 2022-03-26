<?php

namespace App\Controller;

use App\Entity\Rent;
use App\Entity\User;
use App\Form\LocationType;
use App\Form\SignatureLocataire;
use App\Form\SignatureMandataire;
use App\Repository\RentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/location')]
class LocationController extends AbstractController
{
    #[Route('/', name: 'app_location_index', methods: ['GET'])]
    public function index(RentRepository $locationRepository): Response
    {
        return $this->render('location/index.html.twig', [
            'locations' => $locationRepository->findAll(),
        ]);
    }

    #[Route('/{id}/newSM', name: 'app_location_newSM', methods: ['GET', 'POST'])]
    public function newSM(Request $request, EntityManagerInterface $entityManager, RentRepository $locationRepository): Response
    {
        $location = new Rent();
        $form = $this->createForm(SignatureMandataire::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($location);
            $entityManager->flush();

            return $this->redirectToRoute('app_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location/signman.html.twig', [
            'location' => $location,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/newSL', name: 'app_location_newSL', methods: ['GET', 'POST'])]
    public function newSL(Request $request, EntityManagerInterface $entityManager, RentRepository $locationRepository): Response
    {
        $location = new Rent();
        $form = $this->createForm(SignatureLocataire::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($location);
            $entityManager->flush();

            return $this->redirectToRoute('app_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location/signloc.html.twig', [
            'location' => $location,
            'form' => $form,
        ]);
    }


    #[Route('/{id}/edit', name: 'app_location_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rent $location, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location/edit.html.twig', [
            'location' => $location,
            'form' => $form,
        ]);
    }
}
