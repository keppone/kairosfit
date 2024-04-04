<?php

namespace App\Controller;

use Twig\Environment;
use App\Repository\PartnerRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    #[Route('/', name: 'home')]

    /**
     * @throws {\Twig\Error\SyntaxError}
     * @throws {\Twig\Error\RuntimeError}
     * @throws {\Twig\Error\LoaderError}
     */

    public function index(PartnerRepository $repository): Response
    {
        $partners = $repository->findLatest();
        return new Response($this->render('pages/home.html.twig', [
            'partners'=>$partners
        ]));
    }
}




