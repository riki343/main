<?php

namespace Main\MainBundle\Controller;

use Doctrine\ORM\EntityManager;
use Main\MainBundle\Entity\AdminRecord;
use Main\MainBundle\Entity\KeysForAccess;
use Main\MainBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class IndexController extends Controller
{
    /**
     * @Route("/login", name="login_route")
     * @param Request $request
     * @param null $param
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request, $param = null)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();
        if ($error && $error->getMessageKey() == 'Invalid credentials.') {
            $error = 'Неправильный логин или пароль!';
        } else if ($error) {
            $error = $error->getMessageKey();
        }


        $lastUsername = $authenticationUtils->getLastUsername();

        if ($param != null) $error = $param;

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
        $enteredEmail = $request->request->get('userEmail');
        $user = $this->getDoctrine()->getRepository('MainMainBundle:User')->findOneBy(array('email' =>$enteredEmail));
        if ($user == null)
            return $this->forward('MainMainBundle:Index:login', array('param' => "Не найден Email!"));

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $keyForAccess = KeysForAccess::addKeyForForgotPassword($em, $user);

        $link = $this->get('router')->generate('main_reset_password_page', array('keyForAccess' => $keyForAccess) ,true);

        $message = "Здраствуйте, " . $user->getName();
        $message .= "<br><br> Чтобы восстановить свой пароль, <br> перейдите по следующей ссылке: <br>" . $link;

        $this->get('main.notifier')->sendNotificationToEmail($user->getEmail(), $message, "easytoinvest.net Восстановление пароля");

        return $this->forward('MainMainBundle:Index:login', array('param' => "Мы отправили вам Email с дальнейшими инструкциями!"));
    }

    /**
     * @param Request $request
     * @param $keyForAccess
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function resetPasswordAction(Request $request, $keyForAccess)
    {
        $recordFromKey = $this->getDoctrine()->getRepository('MainMainBundle:KeysForAccess')->findOneBy(array('keyForForgotPassword' => $keyForAccess));
        if (!$recordFromKey) throw new NotFoundHttpException('Страница не найдена');
        $userid = $recordFromKey->getUserid();
        $em = $this->getDoctrine()->getManager();
        $allRecords = $em->getRepository('MainMainBundle:KeysForAccess')->findBy(array('userid' => $userid));
        foreach ($allRecords as $record)
            $em->remove($record);
        $em->flush();
        return $this->render("MainMainBundle::resetPassword.html.twig", array('userid' => $userid));
    }

    /**
     * @param Request $request
     * @param $userid
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function resetPasswordSaveAction(Request $request, $userid)
    {
        $newPassword = $request->request->get('newPassword');
        $repeatNewPassword = $request->request->get('repeatNewPassword');

        $parameters = array(
            'newPassword' => $newPassword,
            'repeatNewPassword' => $repeatNewPassword
        );

        $user = $this->getDoctrine()->getRepository('MainMainBundle:User')->find($userid);
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $status = User::resetPassword($em, $this->get('security.encoder_factory'), $user, $parameters);

        if ($status == 0)
            return $this->render("MainMainBundle::resetPassword.html.twig", array('userid' => $userid, 'zm' => 0));
        return $this->forward('MainMainBundle:Index:login', array('param' => "Пароль успешно изменен!"));
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
        $perfectMoney = $request->request->get('perfectMoney');
        $exists = $this->getDoctrine()->getRepository('MainMainBundle:User')->findOneByPerfectMoney($perfectMoney);
        if ($exists != null)
        {
            return $this->render('MainMainBundle::register.html.twig', array(
                'zm' => "Пользователь с данным perfectMoney уже зарегестрирован"
            ));
        }

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $parameters = array(
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'name' => $name,
            'perfectMoney' => $perfectMoney
        );

        User::addUser($em, $this->get('security.encoder_factory'), $parameters);

        AdminRecord::addNewUser($em);

        $user = $this->getDoctrine()->getRepository('MainMainBundle:User')->findOneBy(array('email' => $email));
        $keyForAccess = KeysForAccess::addKeyForConfirmEmail($em, $user);

        $link = $this->get('router')->generate('main_confirm_email', array('keyForAccess' => $keyForAccess) ,true);

        $message = "Здраствуйте, " . $username;
        $message .= "<br><br> Чтобы подтвердить свой Email, <br> перейдите по следующей ссылке: <br>" . $link;

        $this->get('main.notifier')->sendNotificationToEmail($email, $message, "easytoinvest.net Подтверждение Email");

        return $this->forward('MainMainBundle:Index:login', array('param' => "Поздравляем, вы успешно зарегестрировались. На ваш Email отправлено письмо, по которому вам нужно подтвердить свой Email!"));
    }

    /**
     * @param Request $request
     * @param $keyForAccess
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function confirmEmailAction(Request $request, $keyForAccess)
    {
        $recordFromKey = $this->getDoctrine()->getRepository('MainMainBundle:KeysForAccess')->findOneBy(array('keyForConfirmAccount' => $keyForAccess));
        if (!$recordFromKey) throw new NotFoundHttpException('Страница не найдена');
        $userid = $recordFromKey->getUserid();
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        User::confirmEmail($em, $userid);

        $allRecords = $em->getRepository('MainMainBundle:KeysForAccess')->findBy(array('userid' => $userid));
        foreach ($allRecords as $record)
            $em->remove($record);
        $em->flush();

        return $this->forward('MainMainBundle:Index:login', array('param' => "Поздравляем, вы успешно подтвердили свой Email!"));
    }

    public  function confirmEmailSendAction(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $keyForAccess = KeysForAccess::addKeyForConfirmEmail($em, $user);

        $link = $this->get('router')->generate('main_confirm_email', array('keyForAccess' => $keyForAccess) ,true);

        $message = "Здраствуйте, " . $user->getUsername();
        $message .= "<br><br> Чтобы подтвердить свой Email, <br> перейдите по следующей ссылке: <br>" . $link;

        $this->get('main.notifier')->sendNotificationToEmail($user->getEmail(), $message, "easytoinvest.net Подтверждение Email");

        return $this->render('MainMainBundle::account.html.twig', array('sendToEmail' => ""));
    }
}
