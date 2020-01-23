<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\CcontactType;
use App\Repository\ArticleRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



/**
     * @Route("/home")
     */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $articleRepo)
    {
        $article = $articleRepo->findAll();

        return $this->render('home/home.html.twig',[
            'articles' => $article,
        ]);
    }
    /**
     * @Route("/description/{id}",name="description")
     */
    public function description(Article $article)
    {
        return $this->render('home/detaille_article.html.twig',[
            'article' => $article,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/contact", name="contact")
     */
    public function contact(MailerInterface $mailer,Request $request)
    {
        $form = $this->createForm(CcontactType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $email = (new Email())
                ->from($form->get('email')->getData())
                ->to('zeinebkhairallah95@gmail.com')
                ->subject("Contact Admin")
                ->text($form->get('comment')->getData());
            $mailer->send($email);
            $this->addFlash('MessageSuccess' , 'Message Sent Successfully');
            return $this->redirectToRoute('home');
        }
        return $this->render('home/contact.html.twig',[
            'form' => $form->createView(),
        ]);
    }
}

