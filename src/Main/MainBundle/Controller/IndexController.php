<?php

namespace Main\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('MainMainBundle:Default:index.html.twig');
    }

    public function registerAction($sponsor_id)
    {
        $user = $this->getDoctrine()->getRepository('MainMainBundle:User')->find($sponsor_id);
        $em = $this->getDoctrine()->getManager();
        if ($user != null)
        {
             User::addUser($em, $user);
            return $this->render('MainMainBundle:Default:register.html.twig', array('user' =>$user));
        }
    }
}
