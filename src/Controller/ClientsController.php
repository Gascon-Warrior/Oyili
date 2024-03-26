<?php

namespace App\Controller;

use App\Repository\ClientCaseRepository;
use App\Repository\ClientRepository;
use App\Service\SentenceSplitterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/clients', name: 'clients_')]
class ClientsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ClientRepository $clientRepository): Response
    {
        $clients = $clientRepository->findFeaturedClients();

        return $this->render('clients/index.html.twig', [
            'clients' => $clients,
        ]);
    }

    #[Route('/{slug}', name: 'clientCase')]
    public function clientCase(ClientCaseRepository $clientCaseRepository, SentenceSplitterService $sentenceSplitterService, string $slug, Request $request): Response
    {

        $clientCases = $clientCaseRepository->findClientCases($slug);
        $coverAndPictures = $clientCaseRepository->findVideoCoverAndPictures($slug);

        $sentence = $coverAndPictures[0]['tagline'];
        
        $sentences = $sentenceSplitterService->splitSentence($sentence, 30);        

        return $this->render('clients/clientCase.html.twig', [
            'clientCases' => $clientCases,
            'coverAndPictures' => $coverAndPictures, 
            'sentences' => $sentences
        ]);
    }
}
