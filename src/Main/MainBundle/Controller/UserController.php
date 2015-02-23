<?php

namespace Main\MainBundle\Controller;

use Doctrine\ORM\EntityManager;
use Main\MainBundle\Entity\Matrix;
use Main\MainBundle\Entity\User;
use Main\MainBundle\Entity\UserHistory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

// |@Route| \\
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
// |@Security| \\
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Main\MainBundle\Extras\ChromePhp as console;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller {

    /**
     * @Route("/user/active_account", name="main_userpage_active_account")
     * @Security("has_role('USER_ROLE')")
     * @param Request $request
     * @return Response $response
     */
    public function active_accountAction(Request $request)
    {
        return $this->render('MainMainBundle::account.html.twig', array('zm' => ""));
    }

    /**
     * @Route("/user/statistics", name="main_userpage_statistics")
     * @Security("has_role('USER_ROLE')")
     * @param Request $request
     * @return Response $response
     */
    public function statisticsAction(Request $request)
    {
        return $this->render('MainMainBundle::statistics.html.twig');
    }

    /**
     * @Route("/user/my_team", name="main_userpage_my_team")
     * @Security("has_role('USER_ROLE')")
     * @param Request $request
     * @return Response $response
     */
    public function myTeamAction(Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $child = User::getChild($em, $user->getId());
        if ($child == null) return $this->render('MainMainBundle::myTeam.html.twig',
            array('child' => $child, 'empty' => "У вас пока нет команды"));
        return $this->render('MainMainBundle::myTeam.html.twig', array('child' => $child));
    }

    /**
     * @Route("/user/account", name="main_userpage_account")
     * @Security("has_role('USER_ROLE')")
     * @param Request $request
     * @return Response $response
     */
    public  function accountAction(Request $request)
    {
        return $this->render('MainMainBundle::account.html.twig');
    }

    /**
     * @Route("/user/activateAcount", name="main_activate_acount")
     * @Security("has_role('USER_ROLE')")
     * @param Request $request
     * @return Response $response
     */
    public function activateAcountAction(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();

        $activation = $user->getAccountActive();
        $userwallet = $user->getWallet()->getBalance();
        if($activation == false && $userwallet >= 21) {

            /** @var EntityManager $em */
            $em = $this->getDoctrine()->getManager();

            /** @var Matrix $level */
            $level = Matrix::getNotFullLevel($em);
            $user_id = $user->getId();
            Matrix::addChildToUser($em, $user_id, $level->getId());
            $user = $em->getRepository('MainMainBundle:User')->find($user_id);

            $user->getWallet()->setBalance($userwallet - 21);
            $user->setAccountActive(true);

            /** @var User $parrentId1lvl */
            $parrentId1lvl = $user;
            $notifier = $this->get('main.notifier');
            for($i = 0; $i < 7; $i++) {
                $parrent_1lvl = $em->getRepository('MainMainBundle:User')->find($parrentId1lvl->getSponsorid());
                if ($parrent_1lvl && $parrent_1lvl->getId() == 1) {
                    $parrent_1lvl->childAccountActivate($user, (7 - $i) * 3, $em, $notifier);
                    $em->persist($parrent_1lvl);
                    break;
                } else {
                    $parrent_1lvl->childAccountActivate($user, 3, $em, $notifier);
                }
                $em->persist($parrent_1lvl);
                $parrentId1lvl = $parrent_1lvl;
            }

            $em->flush();
        }
        return $this->render('MainMainBundle::userpage.html.twig');
    }

    /**
     * @Route("/user/withdrawMoney", name="main_withdraw_money")
     * @Security("has_role('USER_ROLE')")
     * @param Request $request
     * @return Response $response
     */
    public function withdrawMoneyAction(Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var User $user */
        $user = $this->getUser();
        $amount = $request->request->get('Amount');
        $user_balance = $user->getWallet()->getBalance();
        if($user_balance >= $amount) {
            $user->getWallet()->setBalance($user_balance - $amount);
            $user->getStatistics()
                ->setSpentMoney($user->getStatistics()->getSpentMoney() + $amount);

            $message = 'Операция по выводу средств на кошелек Perfect Money';
            UserHistory::addToHistory($em, $user->getId(), $amount, $message);
        }
        $em->flush();
        return $this->render('MainMainBundle::userpage.html.twig');
    }

    /**
     * @Route("/user/balance", name="main_balance")
     * @Security("has_role('USER_ROLE')")
     * @return Response $response
     */
    public function balanceAction() {
        return $this->render('@MainMain/balance.html.twig');
    }
}
