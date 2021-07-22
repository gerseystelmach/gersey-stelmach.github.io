<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Portfolio;
use App\Repository\SkillRepository;
use App\Repository\ArticleRepository;
use App\Repository\PortfolioRepository;
use App\Repository\ExperienceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(SkillRepository $skillRepository, PortfolioRepository $portfolioRepository, ExperienceRepository $experienceRepository, ArticleRepository $articleRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'skills' => $skillRepository->findAll(),
            'portfolios' => $portfolioRepository->findAll(),
            'experiences' => $experienceRepository->findAll(),
            'articles' => $articleRepository->findAll(),

        ]);
    }

    /**
     * @Route("/articles", name="home_articles")
     */
    public function articles(ArticleRepository $articleRepository): Response
    {

        return $this->render('home/articles.html.twig', [


            'articles' => $articleRepository->findBy([], ['createdAt' => 'DESC']),
        ]);
    }

    /**
     * @Route("/articles/{id}", name="home_article_show", methods={"GET"})
     */
    public function showArticle(Article $article): Response
    {
        return $this->render('home/articleShow.html.twig', [
            'article' => $article,
        ]);
    }
}
