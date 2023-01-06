<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/registration-form', name: 'app_registration_form')]
    public function registrationForm(): Response
    {
        return $this->render('home/registration-form.html.twig', [
            'controller_name' => 'registration',
        ]);
    }




}
