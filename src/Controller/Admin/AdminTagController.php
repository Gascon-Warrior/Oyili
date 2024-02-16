<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin954*retix/tag', name: 'admin_tag_')]
class AdminTagController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(TagRepository $tagRepository): Response
    {
        $tags = $tagRepository->findAll();

        return $this->render('admin/tag/index.html.twig', [
            'tags' => $tags,
        ]);
    }

    #[Route('/ajout', name: 'add')]
    public function add(EntityManagerInterface $em, Request $request, SluggerInterface $slugger)
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $tag = $form->getData();
            $slug = strtolower($slugger->slug($tag->getLabel()));

            $tag->setLabel($tag->getLabel());
            $tag->setSlug($slug);

            $em->persist($tag);
            $em->flush();

            $this->addFlash('success', 'Le tag a bien été ajouté!');

            return $this->redirectToRoute('admin_tag_index');
        }

        return $this->render('admin/tag/add.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    #[Route('/suppression/{id}', name: 'delete')]
    public function delete(Tag $tag, EntityManagerInterface $em)
    {
        $em->remove($tag);
        $em->flush();
        
        $this->addFlash('success', 'Le tag a bien été supprimé');

        return $this->redirectToRoute('admin_tag_index');
    }

    #[Route('/edition/{id}', name: 'edit')]
    public function edit(Tag $tag, Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            # code...
            $label = $form->get('label')->getData();

            $tag->setLabel($label);
            $slug = strtolower($slugger->slug($label));
            $tag->setSlug($slug);

            $em->persist($tag);
            $em->flush();

            $this->addFlash('success', 'Le tag à bien été modifié');

            return $this->redirectToRoute('admin_tag_index');
        }

        return $this->render('admin/tag/edit.html.twig', [
            'form' => $form->createView(),
            'tag' => $tag
        ]);
    }
}
