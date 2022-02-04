<?php

namespace App\Controller;

use App\Entity\Glasses;
use App\Form\GlassesType;
use App\Repository\GlassesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/glasses')]
class GlassesController extends AbstractController
{
    #[Route('/', name: 'glasses_index', methods: ['GET'])]
    public function index(GlassesRepository $glassesRepository): Response
    {
        return $this->render('glasses/index.html.twig', [
            'glasses' => $glassesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'glasses_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $glass = new Glasses();
        $form = $this->createForm(GlassesType::class, $glass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($glass);
            $entityManager->flush();

            return $this->redirectToRoute('glasses_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('glasses/new.html.twig', [
            'glass' => $glass,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'glasses_show', methods: ['GET'])]
    public function show(Glasses $glass): Response
    {
        return $this->render('glasses/show.html.twig', [
            'glass' => $glass,
        ]);
    }

    #[Route('/{id}/edit', name: 'glasses_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Glasses $glass, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GlassesType::class, $glass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('glasses_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('glasses/edit.html.twig', [
            'glass' => $glass,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'glasses_delete', methods: ['POST'])]
    public function delete(Request $request, Glasses $glass, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$glass->getId(), $request->request->get('_token'))) {
            $entityManager->remove($glass);
            $entityManager->flush();
        }

        return $this->redirectToRoute('glasses_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/wearList', name: 'glasses_wearlist', methods: ['GET', 'POST'])]
    public function addToWearlist(Request $request, Glasses $glass, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser()->getWearlist()->contains($glass)) {
            $this->getUser()->removeWearlist($glass);
        } else {
            $this->getUser()->addWearlist($glass);
        }
        $entityManager->flush();
        
        return $this->json([

            'isInWearlist' => $this->getUser()->isInWearlist($glass)
        
        ]);
    }
}
