<?php

namespace Site\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{
    public function accueilAction()
    {
/*
            return $this->render('@SiteSite/Menu/menu.html.twig', array(
                'id' => $id
            ));*/
        return $this->render('@SiteSite/Menu/menu.html.twig');
    }
}
