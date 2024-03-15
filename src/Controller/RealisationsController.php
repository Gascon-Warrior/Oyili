<?php

namespace App\Controller;

use App\Repository\TagRepository;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RealisationsController extends AbstractController
{
    #[Route('/realisations', name: 'realisations_')]
    public function index(VideoRepository $videoRepository, TagRepository $tagRepository): Response
    {   
        $videos = $videoRepository->findAll();
        $tags = $tagRepository->findAll();

        return $this->render('realisations/index.html.twig', [
            'videos' => $videos,
            'tags' => $tags
        ]);
    }
}
