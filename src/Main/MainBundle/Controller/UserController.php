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
        /** @var User $user */
        $user = $this->getUser();
        $sponsor = $user->getSponsor();
        if ($sponsor == null)
            return $this->render('MainMainBundle::account.html.twig', array('sponsor' => $sponsor));
        return $this->render('MainMainBundle::account.html.twig', array('sponsor' => $sponsor, 'zm' => ""));
    }

    /**
     * @Route("/user/activateAcount", name="main_activate_acount")
     * @Security("has_role('USER_ROLE')")
     * @param Request $request
     * @return Response $response
     */
    public function activateAcountAction(Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $this->getUser();

        $activation = $user->getAccountActive();
        $userwallet = $user->getWallet()->getBalance();
        if($activation == false && $userwallet >= 21) {

            /** @var Matrix $level */
            $level = Matrix::getNotFullLevel($em);
            $user_id = $user->getId();
            Matrix::addChildToUser($em, $user_id, $level->getId());
            $user = $em->getRepository('MainMainBundle:User')->find($user_id);

            $user->getWallet()->setBalance($userwallet - 21);
            $user->setAccountActive(true);

            /** @var User $parrentId1lvl */
            $parrentId1lvl = $user;
            for($i = 0; $i < 7; $i++)
            {
                $parrent_1lvl = $em->getRepository('MainMainBundle:User')->find($parrentId1lvl->getSponsorid());

                $statistics = $parrent_1lvl->getStatistics();
                $statistics->setPeopleCount($statistics->getPeopleCount() + 1);
                $parrent_1lvl->setStatistics($statistics);

                if ($i < 7 && $parrent_1lvl->getId() == 1) {
                    break;
                }

                $message = 'Получено 3$ за активацию аккаунта от пользователя ' .
                    $user->getName() . ' ' . $user->getSurname();
                UserHistory::addToHistory($em, $parrent_1lvl->getId(), $user->getId(), 3, $message);

                $parrent_1lvl->getWallet()
                    ->setBalance($parrent_1lvl->getWallet()->getBalance() + 3);

                $parrent_1lvl->getStatistics()
                    ->setEarnedMoney($parrent_1lvl->getStatistics()->getEarnedMoney() + 3);

                $parrentId1lvl = $parrent_1lvl;
                $em->persist($parrent_1lvl);
            }

            $globalWallet = $em->getRepository('MainMainBundle:User')->find(1);
            $globalWallet->getWallet()
                ->setBalance($globalWallet->getWallet()->getBalance() + 21);

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
        $percent = (0.5 / $amount) * 100;
        $amount_plus_percent = $amount - $percent;
        $user_balance = $user->getWallet()->getBalance();
        if($user_balance >= $amount) {
            $user_balance = $user_balance - $amount;
            $user->getWallet()->setBalance($user_balance);
            $spend = $user->getStatistics()->getSpentMoney();
            $spend = $spend + $amount;
            $user->getStatistics()->setSpentMoney($spend);
            $earned = $user->getStatistics()->getEarnedMoney();
            $earned = $earned - $amount;
            $user->getStatistics()->setEarnedMoney($earned);

            $globalWallet = $em->getRepository('MainMainBundle:User')->find(1);
            $globalWallet_wallet = $globalWallet->getWallet()->getBalance();
            $globalWallet_wallet = $globalWallet_wallet - $amount;
            $globalWallet->getWallet()->setBalance($globalWallet_wallet);
        }
        console::log($amount_plus_percent);
        $em->flush();
        return $this->render('MainMainBundle::userpage.html.twig');
    }
}
