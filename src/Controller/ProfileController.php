<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ProfileType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProfileController extends AbstractController
{
    /**
     * @Route("/profile/edit",name="edit")
     */
    public function edit(EntityManagerInterface $manager,Request $request,ClientRepository $clientRepo)
    {
        $client = $clientRepo->findOneBy([
            'id' => $this->getUser()->getClient()->getId(),
        ]);

        $form = $this->createForm(ProfileType::class,$client);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($client);
            $manager->flush();
            return $this->redirectToRoute('account');
        }
        return $this->render('profile/profile.html.twig',[
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/profile/account/{id}",name="profile.acc")
     */
    public function account(Client $client):Response
    {

        return $this->render('profile/profile.html.twig',[
            'client'=> $client,
        ]);

    }

    /**
     * @Route("/profile", name="profile")
     */
    public function index()
    {

        return $this->render('profile/profile.html.twig', [
        ]);
    }
}
