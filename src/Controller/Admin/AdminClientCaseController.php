<?php

namespace App\Controller\Admin;

use App\Entity\ClientCase;
use App\Form\ClientCaseType;
use App\Repository\ClientCaseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin954*retix/cas-client', name: 'admin_clientCase_')]
class AdminClientCaseController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ClientCaseRepository $clientCaseRepository): Response
    {
        $casClients = $clientCaseRepository->findBy([], ['id' => 'DESC']);

        return $this->render('admin/clientCase/index.html.twig', [
            'casClients' => $casClients,
        ]);
    }

    #[Route('/ajout', name: 'add')]
    public function add(EntityManagerInterface $em, Request $request): Response
    {
        $clientCase = new ClientCase();
        $clientCaseForm = $this->createForm(ClientCaseType::class, $clientCase);

        $clientCaseForm->handleRequest($request);

        if ($clientCaseForm->isSubmitted() && $clientCaseForm->isValid()) {

            $em->persist($clientCase);
            $em->flush();

            $this->addFlash('success', 'Le cas client a bien été ajouté.');
            return $this->redirectToRoute('admin_clientCase_index');
        }

        return $this->render('admin/clientCase/add.html.twig',  [
            'clientCaseForm' => $clientCaseForm->createView(),
        ]);
    }

    #[Route('/edition/{id}', name: 'edit')]
    public function edit(ClientCase $clientCase, EntityManagerInterface $em, Request $request): Response
    {
        $clientCaseForm = $this->createForm(ClientCaseType::class, $clientCase);
        $clientCaseForm->handleRequest($request);

        if ($clientCaseForm->isSubmitted() && $clientCaseForm->isValid()) {

            $em->persist($clientCase);
            $em->flush();

            $this->addFlash('success', 'Le cas client a bien été modifié.');

            return $this->redirectToRoute('admin_clientCase_index');
        }

        return $this->render('admin/clientCase/edit.html.twig', [
            'clientCaseForm' => $clientCaseForm->createView(),
            'clientCase' => $clientCase
        ]);
    }

    #[Route('/suppression/{id}', name: 'delete')]
    public function delete(ClientCase $clientCase, EntityManagerInterface $em)
    {
        $em->remove($clientCase);
        $em->flush();

        $this->addFlash('success', 'Le cas client a bien été supprimé.');

        return $this->redirectToRoute('admin_clientCase_index');
    }
}
