<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreditsController extends AbstractController
{
    #[Route('/credits', name: 'app_credits')]
    public function credits(): Response
    {
        return $this->render('credits/index.html.twig', [
            'controller_name' => 'CreditsController',
        ]);
    }
}
