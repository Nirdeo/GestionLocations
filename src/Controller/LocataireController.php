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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/locataire')]
class LocataireController extends AbstractController
{
    #[Route('/', name: 'app_locataire_index', methods: ['GET'])]
    public function index(UserRepository $locataireRepository): Response
    {
        return $this->render('locataire/index.html.twig', [
            'locataires' => $locataireRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_locataire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $locataire, EntityManagerInterface $entityManager, RentRepository $locationRepository, UserPasswordHasherInterface $locatairePasswordHasher): Response
    {
        $form = $this->createForm(LocataireType::class, $locataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $locataire->setPassword(
                $locatairePasswordHasher->hashPassword(
                    $locataire,
                    $form->get('password')->getData()
                )
            );
            $entityManager->flush();

            $this->addFlash('success', 'Votre profil a bien été modifié.');

            return $this->redirectToRoute('app_locataire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('locataire/edit.html.twig', [
            'locataire' => $locataire,
            'form' => $form,
            'locations' => $locationRepository->findBy(['tenant' => $locataire])
        ]);
    }
}
