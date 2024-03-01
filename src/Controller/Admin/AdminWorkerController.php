<?php

namespace App\Controller\Admin;

use App\Entity\Picture;
use App\Entity\Worker;
use App\Form\WorkerType;
use App\Repository\WorkerRepository;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin954*retix/collaborateur', name: 'admin_worker_')]
class AdminWorkerController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(WorkerRepository $workerRepository): Response
    {

        $workers = $workerRepository->findAll();

        return $this->render('admin/worker/index.html.twig', [
            'workers' => $workers,
        ]);
    }

    #[Route('/ajout', name: 'add')]
    public function add(EntityManagerInterface $em, Request $request, PictureService $pictureService): Response
    {

        $worker = new Worker();
        $workerForm = $this->createForm(WorkerType::class, $worker);

        $workerForm->handleRequest($request);

        if ($workerForm->isSubmitted() && $workerForm->isValid()) {
         
           
            $images = $workerForm->get('picture')->getData();
            $alt = $workerForm->get('alt')->getData();
           
            foreach ($images as $image) {
                $folder = 'img';
                $fichier = $pictureService->add($image, $folder);

                $picture = new Picture();

                $picture->setPictureFileName($fichier);
                $picture->setWorker($worker);
                $picture->setAlt($alt);

                $worker->addPicture($picture);
            }

            $em->persist($worker);
            $em->flush();

            $this->addFlash('success', 'Le collaborateur a bien été ajouté.');

         return $this->redirectToRoute('admin_worker_index'); 
        }

        return $this->render('admin/worker/add.html.twig', [
            'workerForm' => $workerForm->createView(),
        ]);
    }

    #[Route('/edition/{id}', name: 'edit')]
    public function edit(Worker $worker, WorkerRepository $workerRepository): Response
    {

        $workers = $workerRepository->findAll();

        return $this->render('admin/worker/index.html.twig', [
            'workers' => $workers,
        ]);
    }

    #[Route('/suppression/{id}', name: 'delete')]
    public function delete(Worker $worker, WorkerRepository $workerRepository): Response
    {

        $workers = $workerRepository->findAll();

        return $this->render('admin/worker/index.html.twig', [
            'workers' => $workers,
        ]);
    }
}
