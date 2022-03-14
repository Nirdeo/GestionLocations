<?php

namespace App\Controller;

use App\Entity\Rent;
use App\Entity\User;
use App\Form\LocataireType;
use App\Form\LocationType;
use App\Repository\RentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/locataire')]
class LocataireController extends AbstractController
{
    #[Route('/', name: 'locataire', methods: ['GET'])]
    public function index(UserRepository $locataireRepository): Response
    {
        return $this->render('locataire/index.html.twig', [
            'locataires' => $locataireRepository->findAll(),
        ]);
    }



    #[Route('/{id}/new', name: 'app_locataire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, RentRepository $locationRepository): Response
    {
        $location = new Rent();
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($location);
            $entityManager->flush();

            return $this->redirectToRoute('app_locataire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('locataire/new.html.twig', [
            'location' => $location,
            'form' => $form,
            'locations' => $locationRepository->findAll()
        ]);
    }

    #[Route('/{id}', name: 'app_locataire_show', methods: ['GET'])]
    public function show(User $locataire): Response
    {
        return $this->render('locataire/show.html.twig', [
            'locataire' => $locataire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_locataire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $locataire, EntityManagerInterface $entityManager, RentRepository $locationRepository): Response
    {
        $form = $this->createForm(LocataireType::class, $locataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_locataire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('locataire/edit.html.twig', [
            'locataire' => $locataire,
            'form' => $form,
            'locations' => $locationRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_locataire_delete', methods: ['POST'])]
    public function delete(Request $request, User $locataire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $locataire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($locataire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_locataire_index', [], Response::HTTP_SEE_OTHER);
    }
}
