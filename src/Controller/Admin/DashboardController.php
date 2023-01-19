<?php

namespace App\Controller\Admin;

use App\Entity\InfoBus;
use App\Entity\InfosClient;
use App\Entity\LieuDeRdv;
use App\Repository\InfosClientRepository;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractDashboardController
{

    private $infosClientRepository;

    public function __construct(InfosClientRepository $infosClientRepository)
    {
        $this->infosClientRepository = $infosClientRepository;
    }



    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {

        $dateSettings = [
            ['Aujourd\'hui' => new DateTime('now')], 
            ['Demain' => new DateTime('now +1 day')], 
            ['Après demain' => new DateTime('now +2 day')], 
            ];
        
        // list qui enregistre pour chaque date le nombre de whatsapp restant a envoyé par client et par commercant
        $whatsAppToSendByDay = [];
        foreach ($dateSettings as $dates) {
            foreach ($dates as $jour => $date) {  
              
              $countNowClient = $this->infosClientRepository->findBy([
                  "day" =>$date,
                  "envoiClient" => false
                ]);         
                $countNowCommercant = $this->infosClientRepository->findBy([
                    "day" =>$date,
                    "envoiCommercant" => false
                ]);
                $countNowClient = count($countNowClient);
                $countNowCommercant = count($countNowCommercant);
                $whatsAppToSendByDay[] = [
                    'jour' => $jour,
                    'client' => $countNowClient, 
                    'commercant' =>$countNowCommercant
                ]; 
            }
        }

        return $this->render('admin/dashboard.html.twig', [
            'whatsAppToSendByDay' => $whatsAppToSendByDay
        ]);
        
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Bus Hotels Souvenirs')
            ->setLocales([
                'fr', 
            ]);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('site', 'fa-regular fa-eye', 'app_home')->setLinkTarget("_blank");;
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::subMenu('Gestion Clients', 'fa fa-users')->setPermission('ROLE_ADMIN')
            ->setSubItems([
                MenuItem::linkToRoute('WhatsApp','fa fa-rocket', 'app_infos_client_index'),
                MenuItem::linkToCrud('Infos Clients', 'fa fa-address-book', InfosClient::class),
            ]
        );
        
        yield MenuItem::subMenu('Gestion Bus', 'fa fa-bus')
            ->setSubItems([
                MenuItem::linkToCrud('Lieu de RDV', 'fa fa-map-marker', LieuDeRdv::class),
                MenuItem::linkToCrud('Infos Bus', 'fa fa-building', InfoBus::class),
            ]
        );
    }

    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('css/admin.css');
    }
}
