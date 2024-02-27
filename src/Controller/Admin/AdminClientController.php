<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin954*retix/client', name: 'admin_client_')]
class AdminClientController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ClientRepository $clientRepository): Response
    {
        $clients = $clientRepository->findAll();
      
        return $this->render('admin/client/index.html.twig', [
            'clients' => $clients,
        ]);
    }

    #[Route('/ajout', name: 'add')]
    public function add(EntityManagerInterface $em, Request $request, SluggerInterface $slugger, PictureService $pictureService): Response
    { 
        
        $client = new  Client();
        $clientForm = $this->createForm(ClientType::class, $client);

        $clientForm->handleRequest($request);

        if ($clientForm->isSubmitted() && $clientForm->isValid()) {
            
            $image = $clientForm->get('logo')->getData();            
            
            $folder = 'svg';
            // On appelle le service d'ajout
            $fichier = $pictureService->add($image, $folder);            

            $client->setLogo($fichier);

            $slug = strtolower($slugger->slug($client->getCompany()));
            $client->setSlug($slug);
            $em->persist($client);
            $em->flush();

            $this->addFlash('success', 'Le client a bien été ajouté.');

            return $this->redirectToRoute('admin_client_index');
        }

        return $this->render('admin/client/add.html.twig', [
            'clientForm' => $clientForm->createView(),
        ]);        
    }

    #[Route('/edition/{id}', name: 'edit')]
    public function edit(Client $client, Request $request, EntityManagerInterface $em, SluggerInterface $slugger, PictureService $pictureService ): Response
    {
        $client = new Client();

        $clientForm = $this->createForm(ClientType::class, $client);

        $clientForm->handleRequest($request);

        if ($clientForm->isSubmitted() && $clientForm->isValid()) {
            
            $image = $clientForm->get('logo')->getData();

            $folder = 'svg';
            
            $fichier = $pictureService->add($image, $folder);

            $client->setLogo($fichier);            
            
            $slug = strtolower($slugger->slug($client->getCompany()));
            $client->setSlug($slug);
    
            $em->persist($client);
            $em->flush();
    
            $this->addFlash('success', 'Le client a bien été modifié.');

            return $this->redirectToRoute('admin_client_index');
        }

        return $this->render('admin/client/edit.html.twig', [
            'clientForm' => $clientForm->createView(),
        ]);
    }
}
