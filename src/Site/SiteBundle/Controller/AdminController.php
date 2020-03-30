<?php

namespace Site\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function editUsersAction()
    {
        $em = $this->getDoctrine()->getRepository('SiteSiteBundle:Users');
        $users = $em->findAll();
        return $this->render('@SiteSite/Admin/administration.html.twig', array(
            'users' => $users
        ));
    }
}

