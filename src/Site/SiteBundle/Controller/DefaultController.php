<?php

namespace Site\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        // variable globale déclarée dans le fichier config.yml

        // on récupère la variable
        /*
        $global = $this->get("twig")->getGlobals();
        $identifiant = $global["identifiant"];
        if($identifiant == 0){
            return $this->render('@SiteSite/Default/index.html.twig', array(
                'id' => $identifiant
            ));

        } else if($identifiant == 1){
            return $this->render('@SiteSite/Default/index.html.twig', array(
                'id' => $identifiant
            ));

        } else if ($identifiant == 2){
            return $this->render('@SiteSite/Default/index.html.twig', array(
                'id' => $identifiant
            ));
        }*/
        return $this->render('@SiteSite/Default/index.html.twig');
    }
}
