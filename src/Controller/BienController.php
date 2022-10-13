<?php

namespace App\Controller;

use App\Entity\BienSearcher;
use App\Entity\Residence;
use App\Form\BienSearcherType;
use App\Form\BienType;
use App\Repository\RentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Sluggable\Util\Urlizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/bien')]
class BienController extends AbstractController
{
    #[Route('/', name: 'app_bien_index', methods: ['GET'])]
    public function index(RentRepository $locationRepository, Request $request): Response
    {
        // fonction de recherche avec BienSearcher qui utilise la fonction findAllRentedBiens() et findBiensByVille()
        $bienSearcher = new BienSearcher();
        $form = $this->createForm(BienSearcherType::class, $bienSearcher);
        $form->handleRequest($request);

        return $this->render('bien/index.html.twig', [
            'form' => $form->createView(),
            'locations' => $locationRepository->findAll(),
        ]);
    }

    #[IsGranted('ROLE_OWNER')]
    #[Route('/new', name: 'app_bien_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $bien = new Residence();
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // set owner to current user
            $bien->setOwner($this->getUser());

            // traitement de l'ajout de l'upload de inventoryFile et de picture
            $inventoryFile = $form->get('inventoryFile')->getData();
            $picture = $form->get('picture')->getData();

            if ($inventoryFile) {
                $originalFilename = pathinfo($inventoryFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$inventoryFile->guessExtension();

                try {
                    $inventoryFile->move(
                        $this->getParameter('kernel.project_dir').'/public/uploads',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $bien->setInventoryFile($newFilename);
            }

            if ($picture) {
                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$picture->guessExtension();

                try {
                    $picture->move(
                        $this->getParameter('kernel.project_dir').'/public/uploads',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $bien->setPicture($newFilename);
            }

            $entityManager->persist($bien);
            $entityManager->flush();

            return $this->redirectToRoute('app_bien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bien/new.html.twig', [
            'bien' => $bien,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_REPRESENTATIVE')]
    #[Route('/{id}', name: 'app_bien_show', methods: ['GET'])]
    public function show(Residence $bien, RentRepository $locationRepository): Response
    {
        return $this->render('bien/show.html.twig', [
            'bien' => $bien,
            'locations' => $locationRepository->findBy(['residence' => $bien]),
        ]);
    }

    #[IsGranted('ROLE_OWNER')]
    #[Route('/{id}/edit', name: 'app_bien_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Residence $bien, RentRepository $locationRepository, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // traitement de la modification de l'upload de inventoryFile et de picture
            $inventoryFile = $form['inventoryFile']->getData();
            $picture = $form['picture']->getData();

            if ($inventoryFile) {
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads';

                $originalFilename = pathinfo($inventoryFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$inventoryFile->guessExtension();

                $inventoryFile->move(
                    $destination,
                    $newFilename
                );
                $bien->setInventoryFile($newFilename);
            }

            if ($picture) {
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads';

                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$picture->guessExtension();

                $picture->move(
                    $destination,
                    $newFilename
                );
                $bien->setPicture($newFilename);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_bien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bien/edit.html.twig', [
            'bien' => $bien,
            'form' => $form,
            'locations' => $locationRepository->findBy(['residence' => $bien]),
        ]);
    }
}
