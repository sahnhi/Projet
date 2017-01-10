<?php

namespace AppUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $username = null;
        $security = $this->get('security.token_storage');
        $token = $security->getToken();
        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
//        if ($this->get('security.token_storage')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
//          return $this->redirectToRoute('app_front_index');
//        }
        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('user/login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
            'username' => $username
        ));
    }
}