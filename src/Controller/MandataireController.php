<?php

namespace App\Controller;

use App\Entity\Rent;
use App\Entity\User;
use App\Form\MandataireType;
use App\Form\LocationType;
use App\Form\UserType;
use App\Repository\RentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mandataire')]
class MandataireController extends AbstractController
{
    #[Route('/', name: 'app_mandataire_index', methods: ['GET'])]
    public function index(UserRepository $mandataireRepository): Response
    {
        return $this->render('mandataire/index.html.twig', [
            'mandataires' => $mandataireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mandataire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $mandataire = new User();
        $form = $this->createForm(MandataireType::class, $mandataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordHasher->hashPassword($mandataire, $mandataire->getPassword());
            $mandataire->setPassword($password);
            $entityManager->persist($mandataire);
            $entityManager->flush();

            return $this->redirectToRoute('app_mandataire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mandataire/new.html.twig', [
            'mandataire' => $mandataire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mandataire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $mandataire, EntityManagerInterface $entityManager, RentRepository $locationRepository, UserPasswordHasherInterface $mandatairePasswordHasher): Response
    {
        $form = $this->createForm(MandataireType::class, $mandataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $mandataire->setPassword(
                $mandatairePasswordHasher->hashPassword(
                    $mandataire,
                    $form->get('password')->getData()
                )
            );
            $entityManager->flush();

            return $this->redirectToRoute('app_mandataire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mandataire/edit.html.twig', [
            'mandataire' => $mandataire,
            'form' => $form,
            'locations' => $locationRepository->findBy(['tenant' => $mandataire])
        ]);
    }
}
