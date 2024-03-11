<?php

namespace App\Controller\Admin;

use App\Entity\VideoJobWorker;
use App\Form\VideoJobWorkerType;
use App\Repository\VideoJobWorkerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin954*retix/video-role-collaborateur', name: 'admin_videoJobWorker_')]
class AdminVideoJobWorkerController extends AbstractController
{   
    #[Route('/', name: 'index')]
    public function index(VideoJobWorkerRepository $videoJobWorkerRepository): Response
    {   
        $videoJobWorker = $videoJobWorkerRepository->findAll();

        return $this->render('admin/videoJobWorker/index.html.twig', [
            'videoJobWorker' => $videoJobWorker
        ]);
    }

   #[Route('/ajout', name: 'add')]
   public function add(EntityManagerInterface $em, Request $request): Response
   {
        $videoJobWorker = new VideoJobWorker();
        $videoJobWorkerForm = $this->createForm(VideoJobWorkerType::class, $videoJobWorker);

        $videoJobWorkerForm->handleRequest($request);

        if ($videoJobWorkerForm->isSubmitted() && $videoJobWorkerForm->isValid()) {
            
            $em->persist($videoJobWorker);
            $em->flush();

            $this->addFlash('success' , 'La nouvelle entrée a bien été ajoutée');

            return $this->redirectToRoute('admin_videoJobWorker_index');
        }

        return $this->render('admin/videoJobWorker/add.html.twig', [
            'videoJobWorkerForm' => $videoJobWorkerForm->createView(),
        ]);

   } 

   #[Route('/suppression/{id}', name: 'delete')]
   public function delete(VideoJobWorker $videoJobWorker, EntityManagerInterface $em): Response
   {
    $em->remove($videoJobWorker);
    $em->flush();

    $this->addFlash('success', 'La relation a bien été éffacée.');
    
    return $this->redirectToRoute('admin_videoJobWorker_index');
   }
}
