<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\RegistrationType;


class RegistrationController extends AbstractController
{
    
    #[Route('/inscription', name: 'inscription')]
    public function registration(): Response {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        return $this->renderForm('security/registration.html.twig', [
            'form' => $form,
        ]);
    }
} 