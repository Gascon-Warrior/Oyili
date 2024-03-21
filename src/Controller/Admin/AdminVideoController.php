<?php

namespace App\Controller\Admin;

use App\Entity\Video;
use App\Form\VideoType;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin954*retix/video', name: 'admin_video_')]
class AdminVideoController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(VideoRepository $videoRepository): Response
    {

        $videos = $videoRepository->findBy([], ['id' => 'DESC']);

        return $this->render('admin/video/index.html.twig', [
            'videos' => $videos,
        ]);
    }

    #[Route('/ajout', name: 'add')]
    public function add(EntityManagerInterface $em, Request $request): Response
    {

        $video = new Video();
        $videoForm = $this->createForm(VideoType::class, $video);

        $videoForm->handleRequest($request);

        if ($videoForm->isSubmitted() && $videoForm->isValid()) {
            $em->persist($video);
            $em->flush();

            //ajouter en table de liaison
            $this->addFlash('success', 'La vidéo a bien été ajoutée.');

            return $this->redirectToRoute('admin_video_index');
        }

        return $this->render('admin/video/add.html.twig', [
            'videoForm' => $videoForm->createView(),
        ]);
    }

    #[Route('/edition/{id}', name: 'edit')]
    public function edit(Video $video, Request $request, EntityManagerInterface $em): Response
    {
        $videoForm = $this->createForm(VideoType::class, $video);
        $videoForm->handleRequest($request);

        if ($videoForm->isSubmitted() && $videoForm->isValid()) {

            $em->persist($video);
            $em->flush();

            $this->addFlash('success', 'La vidéo a bien été modifiée.');
            return $this->redirectToRoute('admin_video_index');
        }

        return $this->render('admin/video/edit.html.twig', [
            'videoForm' => $videoForm->createView(),
            'video' => $video
        ]);
    }

    #[Route('/suppression/{id}', name: 'delete')]
    public function delete(Video $video, EntityManagerInterface $em): Response
    {
        $em->remove($video);
        $em->flush();

        $this->addFlash('success', 'La vidéo a bien été supprimée.');

        return $this->redirectToRoute('admin_video_index');
    }
}
