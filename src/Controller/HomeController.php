<?php

namespace App\Controller;

use App\Entity\Glasses;
use App\Repository\GlassesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(GlassesRepository $glassesRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'glasses' => $glassesRepository->findAll(),
        ]);
    }
}
