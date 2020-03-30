<?php

namespace Site\SiteBundle\Controller;

use Site\SiteBundle\SiteSiteBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Site\SiteBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ShopController extends Controller
{
    public function commandeAction(Request $request)
    {
        /*
        $db = new Product();
        $db->setPlabel('Série complète Dragon Ball');
        $db->setPrice('269.99');
        $db->setAmount('4');

        $em = $this->getDoctrine()->getManager();
        //fait le lien entre doctrine et l'objet

        $em->persist($db);
        $em->flush();

        return new Response('test');
        */
        $em = $this->getDoctrine()->getRepository('SiteSiteBundle:Product');
        $products = $em->findAll();

        if($request->getMethod() == 'POST'){
            $posts = $request->request->all();
            $post = $request->request->get("product.id");

            return $this->render('@SiteSite/Shop/panier.html.twig',array(
                'post' => $_POST
            ));

           // return $this->redirectToRoute('site_site_panier');

        }

        return $this->render('@SiteSite/Shop/listproduct.html.twig',array(
            'products' => $products
        ));
    }

    public function panierAction()
    {
            return $this->render('@SiteSite/Shop/panier.html.twig',array(
                'post' => []
            ));
    }
}

