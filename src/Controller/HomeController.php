<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Page Home
 */
#[Route('/', name: 'app_')]
class HomeController extends AbstractController
{
    /**
     * Page Home
     *
     * @return Response
     */
    #[Route('', name: 'home')]
    public function index(): Response
    {
        /* Render */
        return $this->render('pages/home/home.html.twig');
    }
}