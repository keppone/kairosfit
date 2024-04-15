<?php
namespace App\Controller;

use App\Entity\Partner;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PartnerRepository;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class PartnerController extends AbstractController
{

    private $repository; 
    
    public function __construct(PartnerRepository $repository, EntityManagerInterface $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager=$entityManager;
    }

    #[Route('/partenaires', name: 'app_partner_index')]
    public function index(): Response
    {
        $this->entityManager->flush();
        return $this->render('partner/index.html.twig', ['current_menu' => 'partners']);
    }

    /**
     * @param Partner $partner
     * @return Response 
     */

    #[Route('/partenaires/{slug}-{id}', name: 'app_partner_show', requirements:["slug"=>"[a-z0-9\-]*"])]
    public function show(Partner $partner, string $slug): Response
    {
        if($partner->getSlug() !== $slug) {
            return $this->redirectToRoute('app_partner_show', [
                'id' => $partner->getId(), 
                'slug' => $partner->getSlug()
            ], status: 301);
        }
        return $this->render('partner/show.html.twig', [
            'partner'=>$partner,
            'current_menu' => 'partners']);
    }
}