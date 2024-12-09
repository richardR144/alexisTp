<?php

namespace App\Controller;

use App\Entity\Animator;
use App\Form\AnimatorType;
use App\Repository\AnimatorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/animator')]
final class AnimatorController extends AbstractController
{
    #[Route(name: 'app_animator_index', methods: ['GET'])]
    public function index(AnimatorRepository $animatorRepository): Response
    {
        return $this->render('animator/index.html.twig', [
            'animators' => $animatorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_animator_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $animator = new Animator();
        $form = $this->createForm(AnimatorType::class, $animator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($animator);
            $entityManager->flush();

            return $this->redirectToRoute('app_animator_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('animator/new.html.twig', [
            'animator' => $animator,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_animator_show', methods: ['GET'])]
    public function show(Animator $animator): Response
    {
        return $this->render('animator/show.html.twig', [
            'animator' => $animator,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_animator_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Animator $animator, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AnimatorType::class, $animator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_animator_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('animator/edit.html.twig', [
            'animator' => $animator,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_animator_delete', methods: ['POST'])]
    public function delete(Request $request, Animator $animator, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$animator->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($animator);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_animator_index', [], Response::HTTP_SEE_OTHER);
    }
}
