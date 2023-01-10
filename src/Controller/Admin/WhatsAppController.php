<?php

namespace App\Controller\Admin;

use App\Entity\InfosClient;
use App\Repository\InfosClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\Internal\ClientState;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/')]
class WhatsAppController extends AbstractController
{
    #[Route('/whatsapp/client/{client}', name: 'app_whats_app_client')]
    public function whatsAppClient(InfosClient $client, InfosClientRepository $infosClientRepository): Response
    {
    
        $client->setEnvoiClient('true');
        $infosClientRepository->save($client, true);

        return $this->render('admin/whats_app/client_WA.html.twig', [
            'infosClient' => $client
        ]);
    }

    #[Route('/whatsapp/commercant/{client}', name: 'app_whats_app_commercant')]
    public function whatsAppCommercant(InfosClient $client, InfosClientRepository $infosClientRepository): Response
    {

        $client->setEnvoiCommercant('true');
        
        $infosClientRepository->save($client, true);

        return $this->render('admin/whats_app/commercant_WA.html.twig', [
            'infosClient' => $client
        ]);
    }

}
