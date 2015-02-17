<?php

namespace Main\MainBundle\Controller;

use Main\MainBundle\Entity\User;
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
        $user = $this->getDoctrine()->getRepository('MainMainBundle:User')->find($sponsor_id);
        if ($user != null)
        {
            $username = $request->request->get('username');
            $allUsers = $this->getDoctrine()->getRepository('MainMainBundle:User')->findAll();
            foreach($allUsers as $usr)
                if ($usr->getUsername() == $username)
                    return $this->render('MainMainBundle:Default:register.html.twig', array('user' =>$user, 'zm' => "Пользователь с данным логином уже зарегестрирован"));

            $password = $request->request->get('password');
            $repeatPassword = $request->request->get('repeatPassword');
            if ($password == $repeatPassword)
                return $this->render('MainMainBundle:Default:register.html.twig', array('user' =>$user, 'zm' => "Пароль и повтренный пароль не совпадают"));

            $email = $request->request->get('email');
            $name = $request->request->get('name');
            $surname = $request->request->get('surname');
            $perfectMoney = $request->request->get('perfectMoney');

            $em = $this->getDoctrine()->getManager();

            $parameters = array(
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'name' => $name,
                'surname' => $surname,
                'perfectMoney' => $perfectMoney,
            );

            User::addUser($em, $this->get('security.encoder_factory'), $parameters);
            return $this->render('MainMainBundle:Default:register.html.twig', array('user' =>$user));
        }
    }
}
