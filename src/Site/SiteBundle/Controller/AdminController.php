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

        if($request->isMethod('post')){
            $getId = $request->get('user.id');
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('SiteSiteBundle:Im1920Utilisateurs')->find($getId);
            $em->remove($user);
            $em->flush();
        }

        return $this->render('@SiteSite/Admin/administration.html.twig', array(
            'users' => $users
        ));
    }
}

