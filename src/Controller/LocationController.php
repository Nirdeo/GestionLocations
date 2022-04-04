<?php

namespace App\Controller;

use App\Entity\Rent;
use App\Form\PremiereSignatureLocataire;
use App\Form\PremiereSignatureMandataire;
use App\Form\SecondeSignatureLocataire;
use App\Form\SecondeSignatureMandataire;
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
        $form = $this->createForm(PremiereSignatureMandataire::class, $location);
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
        $form = $this->createForm(PremiereSignatureLocataire::class, $location);
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


    #[Route('/{id}/editSM', name: 'app_location_editSM', methods: ['GET', 'POST'])]
    public function editSM(Request $request, Rent $location, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PremiereSignatureMandataire::class, $location);
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

    #[Route('/{id}/editSL', name: 'app_location_editSL', methods: ['GET', 'POST'])]
    public function editSL(Request $request, Rent $location, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PremiereSignatureLocataire::class, $location);
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
