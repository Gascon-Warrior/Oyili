<?php

namespace App\Controller\Admin;

use App\Entity\Job;
use App\Form\JobType;
use App\Repository\JobRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin954*retix/job', name: 'admin_job_')]
class AdminJobController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(JobRepository $jobRepository): Response
    {
        $jobs = $jobRepository->findAll();

        return $this->render('admin/job/index.html.twig', [
            'jobs' => $jobs,
        ]);
    }

    #[Route('/ajout', name: 'add')]
    public function add(EntityManagerInterface $em, Request $request): Response
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($job);
            $em->flush();

            $this->addFlash('success', 'Le métier a bien été ajouté.');

            return $this->redirectToRoute('admin_job_index');
        }


        return $this->render('admin/job/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edition/{id}', name: 'edit')]
    public function edit(Job $job, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $label = $form->get('label')->getData();
            $job->setLabel($label);

            $em->persist($job);
            $em->flush();

            $this->addFlash('succes', 'Le métier a bien été modifié');

            return $this->redirectToRoute('admin_job_index');
        }

        return $this->render('admin/job/edit.html.twig', [
            'form' => $form->createView(),
            'job' => $job
        ]);
    }

    #[Route('/suppression/{id}', name: 'delete')]
    public function delete(Job $job, EntityManagerInterface $em)
    {
        $em->remove($job);
        $em->flush();

        $this->addFlash('succes', 'Le métier a bien été supprimé.');

        return $this->redirectToRoute('admin_job_index');
    }
}
