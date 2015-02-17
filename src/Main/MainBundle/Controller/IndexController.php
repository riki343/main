<?php

namespace Main\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('MainMainBundle:Default:index.html.twig');
    }

    public function registerAction(Request $request, $sponsor_id)
    {
        $username = $request->request->get('username');
        $password = $request->request->get('password');
        $repeatPassword = $request->request->get('repeatPassword');
        $email = $request->request->get('email');
        $name = $request->request->get('name');
        $surname = $request->request->get('surname');
        $perfectMoney = $request->request->get('perfectMoney');
        $statusAgreeRules = $request->request->get('statusAgreeRules');
        $statusAgreeEthics = $request->request->get('statusAgreeEthics');

        $parameters = array(
            'username' => $username,
            'password' => $password,
            'repeatPassword' => $repeatPassword,

        );

        $user = $this->getDoctrine()->getRepository('MainMainBundle:User')->find($sponsor_id);
        $em = $this->getDoctrine()->getManager();
        if ($user != null)
        {
             User::addUser($em, $user);
            return $this->render('MainMainBundle:Default:register.html.twig', array('user' =>$user));
        }
    }
}
