<?php

namespace App\Controller;

use App\Entity\Rent;
use App\Entity\User;
use App\Form\LocationType;
use App\Form\PremiereSignatureLocataire;
use App\Form\PremiereSignatureMandataire;
use App\Repository\RentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/location')]
class LocationController extends AbstractController
{

    // afficher uniquement la liste des locations de l'utilisateur connecté
    #[Route('/', name: 'app_location_index', methods: ['GET'])]
    public function index(RentRepository $locationRepository): Response
    {
        $locataire = $this->getUser();
        $locataireId = $locataire->getId();
        $locations = $locationRepository->findBy(['tenant' => $locataireId]);

        return $this->render('location/index.html.twig', [
            'locations' => $locations,
        ]);
    }

    #[Route('/{id}', name: 'app_location_show', methods: ['GET'])]
    public function show(RentRepository $locationRepository, Rent $location): Response
    {
        return $this->render('location/show.html.twig', [
            'locations' => $locationRepository->findAll(),
            'location' => $location,
        ]);
    }

    #[Route('/{id}/new', name: 'app_location_new', methods: ['GET', 'POST'])]
    public function new(Request $request, User $locataire, EntityManagerInterface $entityManager, RentRepository $locationRepository): Response
    {
        $location = new Rent();
        $location->setTenant($locataire);
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($location);
            $entityManager->flush();

            return $this->redirectToRoute('app_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location/new.html.twig', [
            'locataire' => $locataire,
            'location' => $location,
            'form' => $form,
            'locations' => $locationRepository->findBy(['tenant' => $locataire]),
        ]);
    }

    #[Route('/{id}/editPSM', name: 'app_location_editSM', methods: ['GET', 'POST'])]
    public function editPSM(Request $request, Rent $location, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PremiereSignatureMandataire::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location/edit_psm.html.twig', [
            'location' => $location,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/editSSM', name: 'app_location_editSM', methods: ['GET', 'POST'])]
    public function editSSM(Request $request, Rent $location, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PremiereSignatureMandataire::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location/edit_ssm.html.twig', [
            'location' => $location,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/editPSL', name: 'app_location_editSL', methods: ['GET', 'POST'])]
    public function editPSL(Request $request, Rent $location, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PremiereSignatureLocataire::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location/edit_psl.html.twig', [
            'location' => $location,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/editSSL', name: 'app_location_editSL', methods: ['GET', 'POST'])]
    public function editSSL(Request $request, Rent $location, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PremiereSignatureLocataire::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location/edit_ssl.html.twig', [
            'location' => $location,
            'form' => $form,
        ]);
    }
}
