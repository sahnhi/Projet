<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use AppBundle\Form\UserType as userForm;
use AppBundle\Entity\User;

class FrontController extends Controller
{
    /**
     * @Route("/front")
     */
    public function indexAction(Request $request)
    {
        $user = new User();
        $userForm = $this->createForm('AppBundle\Form\UserType', $user);  
//        $userForm = $this->get('form.factory')->create(new UserType());
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }
        return $this->render('front/index.html.twig', [
            'userForm' => $userForm->createView(),
        ]);
    }
}
