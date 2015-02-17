<?php

namespace Main\MainBundle\Controller;

use Main\MainBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\SecurityContext;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('MainMainBundle:Default:index.html.twig');
    }

    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('MainMainBundle::login.html.twig', array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }

    public function registerCheckIdAction(Request $request, $sponsor_id) {
        $user = $this->getDoctrine()->getRepository('MainMainBundle:User')->find($sponsor_id);
        if ($user != null) {
            return $this->render('MainMainBundle::register.html.twig', array('user' => $user,
                'sponsor_id' => $sponsor_id));
        }
    }

    public function registerAction(Request $request, $sponsor_id)
    {
        $username = $request->request->get('username');
        $user = $this->getDoctrine()->getRepository('MainMainBundle:User')->find($sponsor_id);
        $exists = $this->getDoctrine()->getRepository('MainMainBundle:User')->findOneByUsername($username);
        if ($exists != null) {
            return $this->render('MainMainBundle::register.html.twig', array('user' => $user,
                'zm' => "Пользователь с данным логином уже зарегестрирован", "sponsor_id" => $sponsor_id));
        }

        $password = $request->request->get('password');
        $repeatPassword = $request->request->get('repeatPassword');
        if ($password != $repeatPassword)
            return $this->render('MainMainBundle::register.html.twig', array('user' => $user,
                'zm' => "Пароль и повтренный пароль не совпадают", "sponsor_id" => $sponsor_id));

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
            'sponsor_id' => $sponsor_id
        );

        User::addUser($em, $this->get('security.encoder_factory'), $parameters);
        return $this->redirectToRoute('main_login');
    }
}
