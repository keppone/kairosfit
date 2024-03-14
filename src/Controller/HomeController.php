<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;

class HomeController extends AbstractController
{

    #[Route('/', name: 'home')]

    /**
     * @throws {\Twig\Error\SyntaxError}
     * @throws {\Twig\Error\RuntimeError}
     * @throws {\Twig\Error\LoaderError}
     */

    public function index(): Response
    {
        return new Response($this->render('pages/home.html.twig'));
    }
}




