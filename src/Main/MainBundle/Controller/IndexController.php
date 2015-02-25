<?php

namespace Main\MainBundle\Controller;

use Main\MainBundle\Entity\AdminRecord;
use Main\MainBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Main\MainBundle\Extras\ChromePhp as console;

class IndexController extends Controller
{
    public function indexAction() {
        return $this->render('MainMainBundle::home.html.twig');
    }

    /**
     * @Route("/login", name="login_route")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('MainMainBundle::login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }


    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction() {

    }

    /**
     * @Route("/user/forgot_password", name="main_userpage_forgot_password")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public  function  forgotPasswordAction(Request $request)
    {

    }

    /**
     * @Route("/signup", name="main_signup")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerCheckIdAction(Request $request) {
        return $this->render('MainMainBundle::register.html.twig');
    }

    /**
     * @Route("/signup_action", name="main_signup_action")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        $username = $request->request->get('username');
        $exists = $this->getDoctrine()->getRepository('MainMainBundle:User')->findOneByUsername($username);
        if ($exists != null) {
            return $this->render('MainMainBundle::register.html.twig', array(
                'zm' => "Пользователь с данным логином уже зарегестрирован"
            ));
        }

        $password = $request->request->get('password');
        $repeatPassword = $request->request->get('repeatPassword');
        if ($password != $repeatPassword)
            return $this->render('MainMainBundle::register.html.twig', array(
                'zm' => "Пароли не совпадают"
            ));

        $email = $request->request->get('email');
        $name = $request->request->get('name');
        $surname = $request->request->get('surname');
        $perfectMoney = $request->request->get('perfectMoney');
        $exists = $this->getDoctrine()->getRepository('MainMainBundle:User')->findOneByPerfectMoney($perfectMoney);
        if ($exists != null)
        {
            return $this->render('MainMainBundle::register.html.twig', array(
                'zm' => "Пользователь с данным perfectMoney уже зарегестрирован"
            ));
        }

        $em = $this->getDoctrine()->getManager();

        $parameters = array(
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'name' => $name,
            'surname' => $surname,
            'perfectMoney' => $perfectMoney
        );

        User::addUser($em, $this->get('security.encoder_factory'), $parameters);

        AdminRecord::addNewUser($em);

        return $this->redirectToRoute('main_login');
    }
}
