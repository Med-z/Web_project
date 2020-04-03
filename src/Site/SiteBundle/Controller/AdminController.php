<?php

namespace Site\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function editUsersAction(Request $request)
    {

        $em = $this->getDoctrine()->getRepository('SiteSiteBundle:Im1920Utilisateurs');
        $users = $em->findAll();

        return $this->render('@SiteSite/Admin/administration.html.twig', array(
            'users' => $users
        ));
    }

    public function deleteAction(Request $request, $id)
    {
            $em = $this->getDoctrine()->getManager();
            $prd_cmd = $em->getRepository('SiteSiteBundle:Im1920Prod_cmd')->findAll();
            $pr = $em->getRepository('SiteSiteBundle:Im1920Product');
            foreach($prd_cmd as $p){
                if($p->getCmdId() == $id){
                    $produit = $pr->findById($p->getProdId());
                    $produit[0]->setAmount($produit[0]->getAmount() + $p->getQte());
                    $em->remove($p);
                }
            }
            $users = $em->getRepository('SiteSiteBundle:Im1920Utilisateurs')->findAll();
            foreach($users as $user){
                if($user->getId() == $id){
                    $em->remove($user);
                    $em->flush();
                    return $this->render('@SiteSite/Admin/suppression.html.twig', array(
                        'id' => $id
                    ));
                }
            }

    }
}

