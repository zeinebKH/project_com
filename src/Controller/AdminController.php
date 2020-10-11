<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\ClientRepository;
use App\Repository\CommandeRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(ClientRepository $clientRepository,CommandeRepository $commandeRepository,UserRepository $userRepository,ArticleRepository $articleRepository): Response
    {
//        $users = $userRepository->findAll();
//        $articles = $articleRepository->findAll();
//        $comCompleted = $commandeRepository->findBy([
//            'status' => "Completed"
//        ]);
//        $comCanceled = $commandeRepository->findBy([
//            'status' => "Canceled"
//        ]);
//
//        $somme = $commandeRepository->orderSum("Completed");
//
//        $client = $clientRepository->findAll();
//        $commande = $commandeRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
