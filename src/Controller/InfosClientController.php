<?php

namespace App\Controller;

use App\Entity\InfosClient;
use App\Form\InfosClient1Type;
use App\Repository\InfosClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

//#[Route('admin/infos/client')]
class InfosClientController extends AbstractController
{
    #[Route('admin/infos-clients', name: 'app_infos_client_index', methods: ['GET'])]
    public function index(InfosClientRepository $infosClientRepository): Response
    {
        return $this->render('infos_client/index.html.twig', [
            'infos_clients' => $infosClientRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_infos_client_new', methods: ['GET', 'POST'])]
    public function new(Request $request, 
                        InfosClientRepository $infosClientRepository, 
                        ValidatorInterface $validator,
                        TranslatorInterface $translator): Response
    {
        $infosClient = new InfosClient();
        $form = $this->createForm(InfosClient1Type::class, $infosClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infosClientRepository->save($infosClient, true);

            return $this->redirectToRoute('app_infos_client_index', [], Response::HTTP_SEE_OTHER);
        }


        $errorsMessage = null;
        $errors = $validator->validate($infosClient );
        if (count($errors) > 0) {
            $errorsMessage = $translator->trans('"The form contains some errors. Please check your answers."');
        }

        return $this->render('infos_client/new.html.twig', [
            'infos_client' => $infosClient,
            'form' => $form,
            'errorsMessage' => $errorsMessage,
            'errors' => $errors
        ]);
    }

    #[Route('/{id}', name: 'app_infos_client_show', methods: ['GET'])]
    public function show(InfosClient $infosClient): Response
    {
        return $this->render('infos_client/show.html.twig', [
            'infos_client' => $infosClient,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_infos_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InfosClient $infosClient, InfosClientRepository $infosClientRepository): Response
    {
        $form = $this->createForm(InfosClient1Type::class, $infosClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infosClientRepository->save($infosClient, true);

            return $this->redirectToRoute('app_infos_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('infos_client/edit.html.twig', [
            'infos_client' => $infosClient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_infos_client_delete', methods: ['POST'])]
    public function delete(Request $request, InfosClient $infosClient, InfosClientRepository $infosClientRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$infosClient->getId(), $request->request->get('_token'))) {
            $infosClientRepository->remove($infosClient, true);
        }

        return $this->redirectToRoute('app_infos_client_index', [], Response::HTTP_SEE_OTHER);
    }
}
