<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(SessionInterface $session,ArticleRepository $articleRepository)
    {
        $panier =$session->get('panier',[]);
        $panierData = [];
        foreach ($panier as $id =>$quantite){
            $panierData[]=[
                'article' => $articleRepository->find($id),
                'quantity' =>$quantite
            ];
        }
        $total=0;
        foreach ($panierData as $item)
        {
            $totaleItem = $item['article']->getPrix() * $item['quantity'];
            $total += $totaleItem;
        }
        return $this->render('cart/index.html.twig', [
            'items' => $panierData,
            'total'=>$total
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/panier/add/{id}",name="add_cart")
     */
    public function add($id, SessionInterface $session)
    {
        $panier =$session->get('panier',[]);
        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id]=1;
        }
        $session->set('panier',$panier);
        return $this->redirectToRoute('cart');
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/panier/remove/{id}",name="remove_cart")
     */
    public function remove($id,SessionInterface $session)
    {
        $panier =$session->get('panier',[]);
        if(!empty($panier[$id])){
            unset($panier[$id]);
        }
        $session->set('panier',$panier);
        return $this->redirectToRoute('cart');
    }

}
