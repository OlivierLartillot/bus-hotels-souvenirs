<?php

namespace App\Controller\Admin;

use App\Entity\InfosClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/')]
class WhatsAppController extends AbstractController
{
    #[Route('/whatsapp/client/{client}', name: 'app_whats_app_client')]
    public function whatsAppClient(InfosClient $client): Response
    {
    
        return $this->render('admin/whats_app/client_WA.html.twig', [
            'infosClient' => $client
        ]);
    }

    #[Route('/whatsapp/commercant/{client}', name: 'app_whats_app_commercant')]
    public function whatsAppCommercant(InfosClient $client): Response
    {
        return $this->render('admin/whats_app/commercant_WA.html.twig', [
            'infosClient' => $client
        ]);
    }

}
