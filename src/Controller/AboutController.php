<?php

namespace App\Controller;

use App\Entity\Worker;
use App\Repository\WorkerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AboutController extends AbstractController
{
    
    #[Route('/a-propos', name: 'about_')]
    public function index(WorkerRepository $workerRepository): Response
    {   
        $workers = $workerRepository->findAll();

        return $this->render('about/index.html.twig', [
            'workers' => $workers,
        ]);
    }
}
