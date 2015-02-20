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
        $user = $this->getUser();

        $activation = $user->getAccountActive();
        $userwallet = $user->getWallet()->getBalance();
        if($activation != 1 && $userwallet >= 21) {

            //-----(user - 21$)
            $userId = $user->getId();
            $userwallet = $user->getWallet()->getBalance();
            $userwallet = $userwallet - 21;
            $em = $this->getDoctrine()->getEntityManager();
            $user->getWallet()->setBalance($userwallet);
            $user->setAccountActive(1);
            $em->flush();
            $parrentId1lvl = $user->getSponsorid();
            //----------(user - 21$)

            //------(parrent 1 level +3$)
            $parrent_1lvl = $em->getRepository('MainMainBundle:User')->find($parrentId1lvl);
            //$parrentId_1lvl = $parrent_1lvl->getId();
            $parrent_1lvl_wallet = $parrent_1lvl->getWallet()->getBalance();
            $parrent_1lvl_wallet = $parrent_1lvl_wallet + 3;
            $em = $this->getDoctrine()->getEntityManager();
            $parrent_1lvl->getWallet()->setBalance($parrent_1lvl_wallet);

            $parrent_1lvl_Statistic_earned_money = $parrent_1lvl->getStatistics()->getEarnedMoney();
            $parrent_1lvl_Statistic_earned_money +=   3;
            $parrent_1lvl->getStatistics()->setEarnedMoney($parrent_1lvl_Statistic_earned_money);
            $em->flush();
            $parrentId2lvl = $parrent_1lvl->getSponsorid();
            console::log('$parrent_1lvl_wallet', $parrent_1lvl_wallet);
            //---------(parrent 1 level +3$)

            //------(parrent 2 level +3$)
            $parrent_2lvl = $em->getRepository('MainMainBundle:User')->find($parrentId2lvl);
            //$parrentId_2lvl = $parrent_2lvl->getId();
            $parrent_2lvl_wallet = $parrent_2lvl->getWallet()->getBalance();
            $parrent_2lvl_wallet = $parrent_2lvl_wallet + 3;
            $em = $this->getDoctrine()->getEntityManager();
            $parrent_2lvl->getWallet()->setBalance($parrent_2lvl_wallet);

            $parrent_2lvl_Statistic_earned_money = $parrent_2lvl->getStatistics()->getEarnedMoney();
            $parrent_2lvl_Statistic_earned_money +=   3;
            $parrent_2lvl->getStatistics()->setEarnedMoney($parrent_2lvl_Statistic_earned_money);
            $em->flush();
            $parrent_2lvl_wallet = $parrent_2lvl->getWallet()->getBalance();
            $parrentId3lvl = $parrent_2lvl->getSponsorid();
            console::log('$parrent_1lvl_wallet', $parrent_2lvl_wallet);
            //---------(parrent 2 level +3$)

            //---------(parrent 3 level +3$)
            $parrent_3lvl = $em->getRepository('MainMainBundle:User')->find($parrentId3lvl);
            //$parrentId_3lvl = $parrent_3lvl->getId();
            $parrent_3lvl_wallet = $parrent_3lvl->getWallet()->getBalance();
            $parrent_3lvl_wallet = $parrent_3lvl_wallet + 3;
            $em = $this->getDoctrine()->getEntityManager();
            $parrent_3lvl->getWallet()->setBalance($parrent_3lvl_wallet);

            $parrent_3lvl_Statistic_earned_money = $parrent_3lvl->getStatistics()->getEarnedMoney();
            $parrent_3lvl_Statistic_earned_money +=   3;
            $parrent_3lvl->getStatistics()->setEarnedMoney($parrent_3lvl_Statistic_earned_money);
            $em->flush();
            $parrent_3lvl_wallet = $parrent_3lvl->getWallet()->getBalance();
            $parrentId4lvl = $parrent_3lvl->getSponsorid();
            console::log('$parrent_1lvl_wallet', $parrent_3lvl_wallet);
            //---------(parrent 3 level +3$)

            //---------(parrent 4 level +3$)
            $parrent_4lvl = $em->getRepository('MainMainBundle:User')->find($parrentId4lvl);
            //$parrentId_4lvl = $parrent_4lvl->getId();
            $parrent_4lvl_wallet = $parrent_4lvl->getWallet()->getBalance();
            $parrent_4lvl_wallet = $parrent_4lvl_wallet + 3;
            $em = $this->getDoctrine()->getEntityManager();
            $parrent_4lvl->getWallet()->setBalance($parrent_4lvl_wallet);

            $parrent_4lvl_Statistic_earned_money = $parrent_4lvl->getStatistics()->getEarnedMoney();
            $parrent_4lvl_Statistic_earned_money +=   3;
            $parrent_4lvl->getStatistics()->setEarnedMoney($parrent_4lvl_Statistic_earned_money);
            $em->flush();
            $parrent_4lvl_wallet = $parrent_4lvl->getWallet()->getBalance();
            $parrentId5lvl = $parrent_4lvl->getSponsorid();
            console::log('$parrent_1lvl_wallet', $parrent_4lvl_wallet);
            //---------(parrent 4 level +3$)

            //---------(parrent 5 level +3$)
            $parrent_5lvl = $em->getRepository('MainMainBundle:User')->find($parrentId5lvl);
            //$parrentId_5lvl = $parrent_5lvl->getId();
            $parrent_5lvl_wallet = $parrent_5lvl->getWallet()->getBalance();
            $parrent_5lvl_wallet = $parrent_5lvl_wallet + 3;
            $em = $this->getDoctrine()->getEntityManager();
            $parrent_5lvl->getWallet()->setBalance($parrent_5lvl_wallet);

            $parrent_5lvl_Statistic_earned_money = $parrent_5lvl->getStatistics()->getEarnedMoney();
            $parrent_5lvl_Statistic_earned_money +=   3;
            $parrent_5lvl->getStatistics()->setEarnedMoney($parrent_5lvl_Statistic_earned_money);
            $em->flush();
            $parrent_5lvl_wallet = $parrent_5lvl->getWallet()->getBalance();
            $parrentId6lvl = $parrent_5lvl->getSponsorid();
            console::log('$parrent_1lvl_wallet', $parrent_5lvl_wallet);
            //---------(parrent 5 level +3$)

            //---------(parrent 6 level +3$)
            $parrent_6lvl = $em->getRepository('MainMainBundle:User')->find($parrentId6lvl);
            //$parrentId_6lvl = $parrent_6lvl->getId();
            $parrent_6lvl_wallet = $parrent_6lvl->getWallet()->getBalance();
            $parrent_6lvl_wallet = $parrent_6lvl_wallet + 3;
            $em = $this->getDoctrine()->getEntityManager();
            $parrent_6lvl->getWallet()->setBalance($parrent_6lvl_wallet);

            $parrent_6lvl_Statistic_earned_money = $parrent_6lvl->getStatistics()->getEarnedMoney();
            $parrent_6lvl_Statistic_earned_money +=   3;
            $parrent_6lvl->getStatistics()->setEarnedMoney($parrent_6lvl_Statistic_earned_money);
            $em->flush();
            $parrent_6lvl_wallet = $parrent_6lvl->getWallet()->getBalance();
            $parrentId7lvl = $parrent_6lvl->getSponsorid();
            console::log('$parrent_1lvl_wallet', $parrent_6lvl_wallet);
            //---------(parrent 6 level +3$)

            //---------(parrent 7 level +3$)
            $parrent_7lvl = $em->getRepository('MainMainBundle:User')->find($parrentId7lvl);
            //$parrentId_7lvl = $parrent_7lvl->getId();
            $parrent_7lvl_wallet = $parrent_7lvl->getWallet()->getBalance();
            $parrent_7lvl_wallet = $parrent_7lvl_wallet + 3;
            $em = $this->getDoctrine()->getEntityManager();
            $parrent_7lvl->getWallet()->setBalance($parrent_7lvl_wallet);

            $parrent_7lvl_Statistic_earned_money = $parrent_7lvl->getStatistics()->getEarnedMoney();
            $parrent_7lvl_Statistic_earned_money +=   3;
            $parrent_7lvl->getStatistics()->setEarnedMoney($parrent_7lvl_Statistic_earned_money);
            $em->flush();
            $parrent_7lvl_wallet = $parrent_7lvl->getWallet()->getBalance();
            $parrentId8lvl = $parrent_7lvl->getSponsorid();
            console::log('$parrent_1lvl_wallet', $parrent_7lvl_wallet);
            //---------(parrent 7 level +3$)

            //------Global Wallet + 21$
            $globalWalletID = 1;
            $globalWallet = $em->getRepository('MainMainBundle:User')->find($globalWalletID);
            $em = $this->getDoctrine()->getEntityManager();
            $globalWallet_wallet = $globalWallet->getWallet()->getBalance();
            $globalWallet_wallet = $globalWallet_wallet + 21;
            $globalWallet->getWallet()->setBalance($globalWallet_wallet);
            $em->flush();
            //-------------------Global Wallet + 21$

        }
        return $this->render('MainMainBundle::userpage.html.twig');
    }
}
