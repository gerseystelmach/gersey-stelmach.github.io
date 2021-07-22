<?php

namespace App\Controller;

use App\Entity\Portfolio;
use App\Repository\SkillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(SkillRepository $skillRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'skills' => $skillRepository->findAll(),
        ]);
    }
}
