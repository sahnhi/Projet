<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use AppBundle\Form\UserType;
use AppBundle\Entity\User;

class FrontController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        $username = null;
        $user = new User();
        $userForm = $this->createForm(UserType::class, $user);
        $userForm->handleRequest($request);
        $security = $this->get('security.token_storage');
        $token = $security->getToken();
        
        if (gettype($token->getUser()) == 'object') {
            $username = $token->getUser()->getUsername();
        }
//        if ($token->getUser() != null && $token->getUser()->getUsername() != null) {
//            $username = $token->getUser()->getUsername();
//        }
//        if ($userForm->isSubmitted()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($user);
//            $em->flush();
//        }
        return $this->render('front/index.html.twig', [
            'userForm' => $userForm->createView(),
            'username' => $username
        ]);
    }
}
