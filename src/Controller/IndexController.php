<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        $test = 'Un petit test pour voir si tout fonctionne correctement';
        
        return $this->render('index/index.html.twig', [
            'test' => $test
        ]);
    }
}
