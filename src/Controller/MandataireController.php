<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MandataireController extends AbstractController
{
    #[Route('/mandataire', name: 'mandataire')]
    public function index(): Response
    {
        return $this->render('mandataire/index.html.twig', [
            'controller_name' => 'MandataireController',
        ]);
    }
}
