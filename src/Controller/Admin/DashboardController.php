<?php

namespace App\Controller\Admin;

use App\Entity\InfoBus;
use App\Entity\InfosClient;
use App\Entity\LieuDeRdv;
use App\Repository\InfosClientRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    private $infosClientRepository;

    public function __construct(InfosClientRepository $infosClientRepository)
    {
        $this->infosClientRepository = $infosClientRepository;
    }



    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {


        $dateNowAndMore = $this->infosClientRepository->findByDateMore();

        return $this->render('admin/dashboard.html.twig', [
            'infos_clients' => $dateNowAndMore,
        ]);













        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Bus Hotels Souvenirs');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::subMenu('Gestion Clients', 'fa fa-users')->setPermission('')
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
}
