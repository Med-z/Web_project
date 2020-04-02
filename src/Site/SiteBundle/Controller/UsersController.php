<?php

namespace Site\SiteBundle\Controller;
use Site\SiteBundle\Service\SecondInDayCounter;
use Site\SiteBundle\Entity\Im1920Utilisateurs;
use Site\SiteBundle\Form\Im1920UtilisateursType;
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
                //$user = new Users();
                $user = new Im1920Utilisateurs();
                //récuperation formulaire
                $form = $this->createForm(Im1920UtilisateursType::class,$user);

                //récuperation de la requête
                $form->handleRequest($request);

                //si formulaire soumis
                if($form->isSubmitted()){
                    //on enregistre le nouvel utilisateur dans la base de données

                    $em = $this->getDoctrine()->getManager();
                    // encodage du mot de passe en sha1
                    $user->setMotdepasse((sha1($user->getMotdepasse())));
                    /*
                    $user->setCreated('H:i:s \O\n d/m/Y');
                    $user->setModified($user->getCreated());*/
                    $em->persist($user);
                    $em->flush();

                    return $this->render('@SiteSite/Menu/menu.html.twig');

                }

                // generation html
                $formView = $form->createView();

                return $this->render('@SiteSite/Users/inscription.html.twig', array(
                    'form' => $formView
                ));
    }

    public function editAction(Request $request)
    {
       // le profil à editer doit être passer dans l'url
        $em = $this->getDoctrine()->getManager()->getRepository('SiteSiteBundle:Im1920Utilisateurs');
        // on récupère la variable globale de l'utilisateur connecté
        $connectglobals = $this->get("twig")->getGlobals();
        $connect = $connectglobals["connect"];
        //on trouve les informations de son profil
        $user = $em->findById($connect);
        if (!$user){
            throw $this->createNotFoundException('No user with the id selected');
        }

        $form = $this->createForm( Im1920UtilisateursType::class, $user[0]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            // encodage du mot de passe
            $user[0]->setMotdepasse((sha1($user[0]->getMotdepasse())));
            // modification de la  date
            $user[0]->setModified(new \DateTime('now'));
            $em->flush();
            return $this->redirectToRoute('site_site_menu');
        }

        return $this->render('@SiteSite/Users/editprofil.html.twig', array(
            'form' => $form->createView()
        ));
    }

    // on utilise le service SecondInDayCounter
    public function connexionAction(SecondInDayCounter $secCounter)
    {
        $arg = array('secondInDay' => $secCounter->getsecond());
        return $this->render('@SiteSite/Users/connexion.html.twig',$arg);
    }

    public function deconnexionAction(Request $request)
    {
        return $this->render('@SiteSite/Users/deconnexion.html.twig');
    }
}