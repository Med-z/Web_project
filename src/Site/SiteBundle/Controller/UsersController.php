<?php

namespace Site\SiteBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Site\SiteBundle\Entity\Users;
use Site\SiteBundle\Form\UsersType;
use Site\SiteBundle\Entity\SignIn;
use Site\SiteBundle\Form\SignInType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function inscriptionAction(Request $request)
    {

                $user = new Users();
                //récuperation formulaire
                $form = $this->createForm(UsersType::class,$user);

                //récuperation de la requête
                $form->handleRequest($request);

                //si formulaire soumis
                if($form->isSubmitted()){
                    //on enregistre le nouvel utilisateur dans la base de données

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($user);
                    $em->flush();

                    //return new Response('Utilisateur  inscrit');
                    //return $this->render('@SiteSite/Users/inscription.html.twig');
                    /*return $this->redirectToRoute('site_site_homepage',array(
                        'id' => 1
                    ));*/
                   /* $tmp = 1;
                    return $this->redirectToRoute('site_site_homepage',array(
                        'id' => $tmp
                    ));*/
                    //return $this->redirectToRoute('site_site_homepage', ['id' => 1]);
                    $global = $this->get("twig")->getGlobals();
                    $global["identifiant"]= 1;

                    return $this->render('@SiteSite/Menu/menu.html.twig', array(
                        'id' =>  $global["identifiant"]
                    ));

                }

                // generation html
                $formView = $form->createView();

                return $this->render('@SiteSite/Users/inscription.html.twig', array(
                    'form' => $formView
                ));
    }

    public function editAction(User $user, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form);
            $manager = persist($user);
            $manager->flush();
        }

        return $this->render('boom/edit.html.twig', [
            'formUser' => $form->createView(),
            'user' => $user->getId(),
        ]);
    }

    public function connexionAction(Request $request)
    {/*
        $user = new SignIn();
        //récuperation formulaire
        $form = $this->createForm(SignInType::class,$user);
        if($form->isSubmitted()){
            //on enregistre le nouvel utilisateur dans la base de données
            $logform->getLogin();
            $log = $this->getDoctrine()
                ->getRepository('@SiteSite/Users')
                ->find
            if (!em) {
                throw $this->createNotFoundException(
                    'Aucun produit trouvé pour cet id : '.$id
                );
            }
        }
        // generation html
        $formView = $form->createView();

        return $this->render('@SiteSite/Users/connexion.html.twig', array(
            'form' => $formView
        ));*//*
        if(isset($_POST['envoyer'])) {
            if (isset($_POST['log'])){
                $tmp = $_POST['log'];
                $em = $this->getDoctrine()->getManager();
                $login = $em->getRepository('SiteSiteBundle:Users')->findAll();
                if($tmp == $login){
                    return new Response('Utilisateur  reconnu');
                }
            }
        }*/
        /*
        $user = new SignIn();
        //récuperation formulaire
        $form = $this->createForm(SignInType::class,$user);


        if( $request->getMethod() == 'POST' ) {
            //$form->bindRequest($request);
            $form->handleRequest($request);

            if ($form->isValid() && $form->isSubmitted()) {

                $data = $form->getData();
                $login = $form["login"]->getData();
                $password = $form["password"]->getData();

                $log = $this->getDoctrine()
                    ->getRepository('SiteSiteBundle:Users')
                    ->findOneBy(['login' => $login]);

                $pwd = $this->getDoctrine()
                    ->getRepository('SiteSiteBundle:Users')
                    ->findOneBy(['password' => $password]);

                if(($log == $login) && ($pwd == $password)){
                    return new Response('utilisateur reconnu');
                } else {
                    return new Response('Connexion impossible');
                }


            }
        }
        $formView = $form->createView();

        return $this->render('@SiteSite/Users/connexion.html.twig', array(
            'form' => $formView
        ));*/
        return $this->render('@SiteSite/Users/connexion.html.twig');
    }
}