<?php

namespace App\Controller;

use App\Entity\Residence;
use App\Entity\User;
use App\Form\BienNewType;
use App\Form\BienType;
use App\Form\ResidenceType;
use App\Repository\RentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bien')]
class BienController extends AbstractController
{
    #[Route('/bien', name: 'app_bien_index', methods: ['GET'])]
    public function index(RentRepository $locationRepository): Response
    {
        return $this->render('bien/index.html.twig', [
            'controller_name' => 'BienController',
            'locations' => $locationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bien_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bien = new Residence();
        $form = $this->createForm(BienNewType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bien);
            $entityManager->flush();

            return $this->redirectToRoute('app_bien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bien/new.html.twig', [
            'residence' => $bien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bien_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Residence $bien, EntityManagerInterface $entityManager, RentRepository $locationRepository, User $locataire): Response
    {
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            /** @var UploadedFile $uploadedFile1 */
            /** @var UploadedFile $uploadedFile2 */
            $uploadedFile1 = $form['inventoryFile']->getData();
            $uploadedFile2 = $form['picture']->getData();
            $destination = $this->getParameter('kernel.project_dir') . '/public/assets/uploads';

            $originalFilename1 = pathinfo($uploadedFile1->getClientOriginalName(), PATHINFO_FILENAME);
            $originalFilename2 = pathinfo($uploadedFile2->getClientOriginalName(), PATHINFO_FILENAME);

            $newFilename1 = $originalFilename1 . '-' . uniqid() . '.' . $uploadedFile1->guessExtension();
            $newFilename2 = $originalFilename2 . '-' . uniqid() . '.' . $uploadedFile2->guessExtension();

            $uploadedFile1->move(
                $destination,
                $newFilename1
            );

            $uploadedFile2->move(
                $destination,
                $newFilename2
            );

            $bien->setInventoryFile($newFilename1);

            $bien->setPicture($newFilename2);

            return $this->redirectToRoute('app_bien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bien/edit.html.twig', [
            'residence' => $bien,
            'form' => $form,
            'locations' => $locationRepository->findBy(['tenant' => $locataire]),
        ]);
    }
}
