<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PartnerController extends AbstractController
{
    #[Route('/partenaires', name: 'partner.index')]
    public function index(): Response
    {
        return $this->render('partner/index.html.twig', ['current_menu' => 'partners']);
    }
}