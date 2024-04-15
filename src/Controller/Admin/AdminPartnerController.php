<?php
namespace App\Controller\Admin;

use App\Entity\Partner;
use App\Form\PartnerType;
use App\Repository\PartnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class AdminPartnerController extends AbstractController
{

    private $repository; 
    private $entityManager;

    public function __construct(PartnerRepository $repository, EntityManagerInterface $entityManager)
    {
       $this-> repository = $repository;
       $this-> entityManager= $entityManager;
    }

    #[Route('/admin', name: 'app_admin_partner_index')]
    public function index()
    {
       $partners = $this->repository->findAll();
       return $this->render('admin/partner/index.html.twig', compact('partners'));
    }

    #[Route('/admin/partenaire/créer', name: 'app_admin_partner_new', methods:['GET', 'POST'])]
    public function new(Request $request) : Response
    {
      $partner = new Partner();
      $form= $this->createForm(PartnerType::class, $partner);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()){
         $this->entityManager->persist($partner);
         $this->entityManager->flush();
         $this->addFlash('success', 'Votre création a bien été réalisée');
         return $this->redirectToRoute('app_admin_partner_index');
      }
       return $this->render('admin/partner/new.html.twig', [
      'partner'=>$partner,
      'form'=> $form->createView()
   ]);
    }

    #[Route('/admin/partenaire/{id}/modifier', name: 'app_admin_partner_edit', methods:['GET', 'POST'])]
    public function edit(Partner $partner, Request $request) : Response
    {
      $form= $this->createForm(PartnerType::class, $partner);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()){
         $this->entityManager->flush();
         $this->addFlash('success', 'Votre modification a été prise en compte');
         return $this->redirectToRoute('app_admin_partner_index');
      }

      return $this->render('admin/partner/edit.html.twig', [
      'partner'=>$partner,
      'form'=> $form->createView()
   ]);
    }

    #[Route('/admin/partenaires/{id}/supprimer', name: 'app_admin_partner_delete', methods: ['POST'])]
    public function delete(Request $request, Partner $partner, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partner->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($partner);
            $entityManager->flush();
            $this->addFlash('success', 'La suppression a été réalisée');
        }

        return $this->redirectToRoute('app_admin_partner_index', [], Response::HTTP_SEE_OTHER);
    }
}

