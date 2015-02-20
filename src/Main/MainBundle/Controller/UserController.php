<?php

namespace Main\MainBundle\Controller;

use Doctrine\ORM\EntityManager;
use Main\MainBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;

// |@Route| \\
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
// |@Security| \\
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Main\MainBundle\Extras\ChromePhp as console;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller {
    /**
     * @Route("/user", name="main_userpage")
     * @Security("has_role('USER_ROLE')")
     * @param Request $request
     * @return Response $response
     */
    public function indexAction(Request $request) {
        $user = $this->getUser();
        return $this->render('MainMainBundle::userpage.html.twig');
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
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $child = User::getChild($em, $user->getId());
        if ($child == null) return $this->render('MainMainBundle::myTeam.html.twig', array('child' => $child, 'empty' => "У вас пока нет команды"));
        return $this->render('MainMainBundle::myTeam.html.twig', array('child' => $child));
    }

    /**
     * @Route("/user/activateAcount", name="main_activate_acount")
     * @Security("has_role('USER_ROLE')")
     * @param Request $request
     * @return Response $response
     */
    public function activateAcountAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $activation = $user->getAccountActive();
        $userwallet = $user->getWallet()->getBalance();
        if($activation != 1 && $userwallet >= 21) {

            //-----(user - 21$)
            $userwallet = $user->getWallet()->getBalance();
            $userwallet = $userwallet - 21;
            $user->getWallet()->setBalance($userwallet);
            $user->setAccountActive(1);
            $parrentId1lvl = $user->getSponsorid();
            //----------(user - 21$)

            //------(parrent 1-7 level +3$)
            for($i=0;$i<7;$i++)
            {
                $parrent_1lvl = $em->getRepository('MainMainBundle:User')->find($parrentId1lvl);
                $parrent_1lvl_wallet = $parrent_1lvl->getWallet()->getBalance();
                $parrent_1lvl_wallet = $parrent_1lvl_wallet + 3;
                $parrent_1lvl->getWallet()->setBalance($parrent_1lvl_wallet);

                $parrent_1lvl_Statistic_earned_money = $parrent_1lvl->getStatistics()->getEarnedMoney();
                $parrent_1lvl_Statistic_earned_money += 3;
                $parrent_1lvl->getStatistics()->setEarnedMoney($parrent_1lvl_Statistic_earned_money);
                $parrentId1lvl = $parrent_1lvl->getSponsorid();
            }

            //---------(parrent 1-7 level +3$)

            //------Global Wallet + 21$
            $globalWallet = $em->getRepository('MainMainBundle:User')->find(1);

            $globalWallet_wallet = $globalWallet->getWallet()->getBalance();
            $globalWallet_wallet = $globalWallet_wallet + 21;
            $globalWallet->getWallet()->setBalance($globalWallet_wallet);
            $em->flush();
            //-------------------Global Wallet + 21$

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
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $amount = $request->request->get('Amount');
        $percent = (0.5/$amount)*100;
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
