<?php

namespace Site\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Site\SiteBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    public function indexAction(Request $request)
    {
        $db = new Product();
        $db->setPlabel('Série complète Dragon Ball');
        $db->setPrice('269.99');
        $db->setAmount('4');

        $em = $this->getDoctrine()->getManager();
        //fait le lien entre doctrine et l'objet

        $em->persist($db);
        $em->flush();

        return new Response('test');
    }
}

