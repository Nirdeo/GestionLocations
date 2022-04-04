<?php

namespace App\Controller;

use App\Entity\Residence;
use App\Entity\User;
use App\Form\BienType;
use App\Repository\RentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

    #[Route('/{id}/edit', name: 'app_bien_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Residence $bien, EntityManagerInterface $entityManager, RentRepository $locationRepository, User $locataire): Response
    {
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['inventoryFile']->getData();

            $destination = $this->getParameter('kernel.project_dir') . '/public/assets/uploads';

            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);

            $newFilename = $originalFilename . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

            $uploadedFile->move(
                $destination,
                $newFilename
            );

            $bien->setInventoryFile($newFilename);

            return $this->redirectToRoute('app_bien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bien/edit.html.twig', [
            'residence' => $bien,
            'form' => $form,
            'locations' => $locationRepository->findBy(['tenant' => $locataire]),
        ]);
    }
}
