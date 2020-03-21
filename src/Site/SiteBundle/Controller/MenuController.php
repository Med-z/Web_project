<?php

namespace Site\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{
    public function accueilAction($id)
    {

            return $this->render('@SiteSite/Menu/menu.html.twig', array(
                'id' => $id
            ));
    }
}
