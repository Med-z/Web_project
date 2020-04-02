<?php

namespace Site\SiteBundle\Controller;

use Site\SiteBundle\Entity\Im1920Command;
use Site\SiteBundle\Entity\Im1920Prod_cmd;
use Site\SiteBundle\SiteSiteBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Site\SiteBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

//TODO une fonction qui récupère tous les produits d'une commande d'un user

//ce code paraît bizarre de part une erreurs dans la lecture du sujet 
//qui à donner lieu à une erreur de conception de la base de donnée 
//En effet sur le sujet j'avais lu "le prix total des commandes" (3.8)
// donc j'avait pensé à plusieurs commandes pour un seul utilisateur 
// met en relisant le sujet je me suis rendu compte que ce n'était pas 
// le cas et qu'il était trop tard pour changer la base de donnée.
//Ainsi la table commande est inutile...

class ShopController extends Controller
{
    public function commandeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $pr = $em->getRepository('SiteSiteBundle:Im1920Product');
        $products = $pr->findAll();
        if($request->getMethod() == 'POST'){
            $post = $request->request->get("test");
            $usr = $em->getRepository('SiteSiteBundle:Im1920Utilisateurs');
            $cmd = $em->getRepository('SiteSiteBundle:Im1920Command');
            
            // on récupère la variable globale de l'utilisateur connecté
            $connectglobals = $this->get("twig")->getGlobals();
            $connect = $connectglobals["connect"];

            $Command = null;
            //on créer la nouvelle commande si besoin
            $commands = $cmd->findAll();
            foreach ($commands as $c) {
                if ($c->getUserID() == $connect){
                    $Command = $c;
                }
            }
            if($Command == null){
                $Command= new Im1920Command();
                $Command->setID($connect);
                $Command->setUserID($connect);                
            }

            foreach ($products as $p) {
                $res = $request->request->get($p->getId());
                if($res != 0){
                    if($p->getAmount() >= $res){
                        //TODO geré le cas panier pas vide
                        $prod_cmd = null;
                        foreach ($em->getRepository('SiteSiteBundle:Im1920Prod_cmd')->findAll() as $pc){
                            if($pc->getProdId() == $p->getId() && $pc->getCmdId() == $connect){
                                $prod_cmd = $pc;
                            }
                        }
                        if ($prod_cmd == null) {
                            $prod_cmd = new Im1920Prod_cmd();
                            $prod_cmd->setProdId($p->getId());
                            $prod_cmd->setCmdId($Command->get_ID());
                            $em->persist($prod_cmd);
                        }
                        $prod_cmd->setQte($res + $prod_cmd->getQte());
                        
                        $p->setAmount($p->getAmount() - $res);

                    }
                }
            }
            $em->persist($Command);
            $em->flush();
        }

        return $this->render('@SiteSite/Shop/listproduct.html.twig',array(
            'products' => $products,
        ));
    }

    public function panierAction()
    {
        $total = 0;        
        $products = [];
        // on récupère la variable globale de l'utilisateur connecté
        $connectglobals = $this->get("twig")->getGlobals();
        $connect = $connectglobals["connect"];
        
        $em = $this->getDoctrine()->getManager();
        $prd_cmd = $em->getRepository('SiteSiteBundle:Im1920Prod_cmd')->findAll();
        $pr = $em->getRepository('SiteSiteBundle:Im1920Product');

        foreach($prd_cmd as $p){
            if($p->getCmdId() == $connect){
                $produit = $pr->findById($p->getProdId());                
                $products[] = array($produit[0],$p->getQte(),$p->getQte()*$produit[0]->getPrice());
                $total += $produit[0]->getPrice() * $p->getQte();
            }
        }


        
        
        return $this->render('@SiteSite/Shop/panier.html.twig',array(
                'total' => $total,
                'products' => $products
            ));
    }

    public function deleteAction()
    {
        $connectglobals = $this->get("twig")->getGlobals();
        $connect = $connectglobals["connect"];
        
        $em = $this->getDoctrine()->getManager();
        $prd_cmd = $em->getRepository('SiteSiteBundle:Im1920Prod_cmd')->findAll();
        $pr = $em->getRepository('SiteSiteBundle:Im1920Product');
        foreach($prd_cmd as $p){
            if($p->getCmdId() == $connect){
                $produit = $pr->findById($p->getProdId());                
                $produit[0]->setAmount($produit[0]->getAmount() + $p->getQte());
                $em->remove($p);
            }
        }
        $em->flush();
        return $this->redirectToRoute('site_site_panier');
    }

    public function orderAction()
    {
        $connectglobals = $this->get("twig")->getGlobals();
        $connect = $connectglobals["connect"];
        
        $em = $this->getDoctrine()->getManager();
        $prd_cmd = $em->getRepository('SiteSiteBundle:Im1920Prod_cmd')->findAll();
        $pr = $em->getRepository('SiteSiteBundle:Im1920Product');
        foreach($prd_cmd as $p){
            if($p->getCmdId() == $connect){
                $produit = $pr->findById($p->getProdId());                
                $em->remove($p);
            }
        }
        $em->flush();
        return $this->redirectToRoute('site_site_panier');
    }
}

