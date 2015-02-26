<?php

namespace Main\MainBundle\Controller;

use Doctrine\ORM\EntityManager;
use Main\MainBundle\Entity\AdminRecord;
use Main\MainBundle\Entity\KeysForAccess;
use Main\MainBundle\Entity\Matrix;
use Main\MainBundle\Entity\User;
use Main\MainBundle\Entity\UserHistory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        return $this->render('MainMainBundle::account.html.twig');
    }

    /**
     * @Route("/user/change_profile", name="main_userpage_change_profile")
     * @Security("has_role('USER_ROLE')")
     * @param Request $request
     * @return Response $response
     */
    public  function changeProfileAction(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();
        $FS = new Filesystem();
        if (!$FS->exists(__DIR__ . '/../../../../web/files/' . $user->getUsername()))
            $FS->mkdir(__DIR__ . '/../../../../web/files/' . $user->getUsername());

        $file_path = __DIR__.'/../../../../web/files/' . $user->getAvatar();
        if(file_exists($file_path)) unlink($file_path);

        $em = $this->getDoctrine()->getManager();
        $usr = $em->getRepository('MainMainBundle:User')->find($user->getId());
        $file = $request->files->get('new_image');
        if ($file != null)
        {
            $extension = $file->guessExtension();
            $file_name = rand(1000,100000);
            $file = $file->move(__DIR__.'/../../../../web/files/' . $user->getUsername() . '/avatar',
                $file_name . '.' . $extension);
            $usr->setAvatar('files/' . $user->getUsername() . '/avatar/' . $file_name . '.' . $extension);
        }

        $new_name = $request->request->get('new_name');
        $user->setName($new_name);
        $em->flush();
        return $this->render('MainMainBundle::account.html.twig');
    }

    /**
     * @Route("/user/change_password", name="main_userpage_change_password")
     * @Security("has_role('USER_ROLE')")
     * @param Request $request
     * @return Response $response
     */
    public function changePasswordAction(Request $request)
    {
        $currentPassword = $request->request->get('currentPassword');
        $newPassword = $request->request->get('newPassword');
        $repeatNewPassword = $request->request->get('repeatNewPassword');

        $parameters = array(
            'currentPassword' => $currentPassword,
            'newPassword' => $newPassword,
            'repeatNewPassword' => $repeatNewPassword
        );

        $user = $this->getUser();

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $status = User::changePassword($em, $this->get('security.encoder_factory'), $user, $parameters);

        if ($status == 0)
            return $this->render('MainMainBundle::account.html.twig', array('mes' => 0));
        if ($status == 1)
            return $this->render('MainMainBundle::account.html.twig', array('mes' => 1));
        return $this->render('MainMainBundle::account.html.twig', array('mes' => 2));
    }

    /**
     * @Route("/user/change_perfect_money", name="main_userpage_change_perfect_money")
     * @Security("has_role('USER_ROLE')")
     * @param Request $request
     * @return Response $response
     */
    public function changePerfectMoneyAction(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();
        $enteredEmail = $request->request->get('userEmail');
        if ($user->getEmail() != $enteredEmail)
            return $this->render('MainMainBundle::account.html.twig', array('mes' => 3));

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $keyForAccess = KeysForAccess::addKeyForPerfectMoney($em, $user);

        $link = $this->get('router')->generate('main_userpage_change_perfect_money_page', array('keyForAccess' => $keyForAccess), true);

        $message = "Здраствуйте, " . $user->getName();
        $message .= "<br><br> Чтобы изменить свой Perfect money, <br> перейдите по следующей ссылке: <br>" . $link;
        $mailer = $this->get('mailer');

        $this->get('main.notifier')->sendNotificationToEmail($user->getEmail(), $message, "easytoinvest.net Смена Perfect money");

        return $this->render('MainMainBundle::account.html.twig', array('mes' => 4));
    }


    /**
     * @Route("/user/change_perfect_money/{keyForAccess}", name="main_userpage_change_perfect_money_page")
     * @Security("has_role('USER_ROLE')")
     * @param string $keyForAccess
     * @return Response $response
     */
    public function changePerfectMoneyChangeAction($keyForAccess)
    {
        $recordFromKey = $this->getDoctrine()->getRepository('MainMainBundle:KeysForAccess')->findOneBy(array('keyForPerfectMoney' => $keyForAccess));
        if (!$recordFromKey) throw new NotFoundHttpException('Страница не найдена');
        $userid = $recordFromKey->getUserid();
        $em = $this->getDoctrine()->getManager();
        $allRecords = $em->getRepository('MainMainBundle:KeysForAccess')->findBy(array('userid' => $userid));
        foreach ($allRecords as $record)
            $em->remove($record);
        $em->flush();
        return $this->render('MainMainBundle::changePerfectMoney.html.twig');
    }

    /**
     * @Route("/user/change_perfect_money_save", name="main_userpage_change_perfect_money_page_save")
     * @Security("has_role('USER_ROLE')")
     * @param Request $request
     * @return Response $response
     */
    public function changePerfectMoneySaveAction(Request $request)
    {
        $user = $this->getUser();
        $newPerfectMoney = $request->request->get('newPerfectMoney');

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $status = User::changePerfectMoney($em, $user, $newPerfectMoney);
        if ($status == 0)
            return $this->render('MainMainBundle::changePerfectMoney.html.twig', array('zm' => 0));
        return $this->render('MainMainBundle::changePerfectMoney.html.twig', array('zm' => 1));
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

        if ($activation == false && $userwallet >= 21) {

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
            for ($i = 0; $i < 7; $i++) {
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

            AdminRecord::addNewActiveUser($em); // For admin statistics

            $em->flush();
            return $this->render('MainMainBundle::balance.html.twig', array(
                'err_cash' => "Поздравляем, активация прошла успешно  !!!"));
        }
        return $this->render('MainMainBundle::balance.html.twig', array(
            'err_cash' => "На вашем счету, в системе, не достаточно денег!!!"));
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
        if($user_balance >= $amount+($amount*0.02)) {
            $global = AdminRecord::getGlobalWallet($em);
            $AccountID =  $global['AccountID'];
            $PassPhrase =  $global['PassPhrase'];
            $payer_Account =  $global['Wallet'];
            $payee_Account = $user->getPerfectMoney(); //акаунт перфект моней
            $payment_id = rand(1,9999);

            $f_invest=fopen('https://perfectmoney.is/acct/confirm.asp?'
                . 'AccountID=' . $AccountID . '&'
                . 'PassPhrase=' . $PassPhrase . '&'
                .'Payer_Account=' . $payer_Account . '&'
                . 'Payee_Account=' . $payee_Account . '&'
                . 'Amount='.$amount . '&'
                . 'PAY_IN=1&'
                . 'PAYMENT_ID=' . $payment_id, 'rb');

            if($f_invest===false)
            {
                echo 'error openning url';
            }
            $out_invest=array(); $out_invest="";
            while(!feof($f_invest)) $out_invest.=fgets($f_invest);
            fclose($f_invest);
            if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $out_invest, $result_invest, PREG_SET_ORDER))
            {
                echo 'Ivalid output';
                exit;
            }
            $ar_invest="";
            foreach($result_invest as $item_invest)
            {
                $key_invest=$item_invest[1];
                $ar_invest[$key_invest]=$item_invest[2];
            }
            if(array_key_exists('ERROR',$ar_invest))
            {
                if($ar_invest['ERROR'] == 'Not enough money to pay')
                {
                    return $this->render('MainMainBundle::balance.html.twig'
                        , array(
                            'err_cash' => 'Не достаточно средств на счету, пожалуйста пополните свой счет с учотом комиссии!!!'));
                }
                else {
                    return $this->render('MainMainBundle::balance.html.twig'
                        , array(
                            'err_cash' => $ar_invest['ERROR']));
                }
            }
            else {

                $user->getWallet()->setBalance($user_balance -( $amount+($amount * 0.02)));
                AdminRecord::removeFromGlobal($em,$amount+($amount * 0.02));
                $user->getStatistics()
                    ->setSpentMoney($user->getStatistics()->getSpentMoney() + $amount);

                $message = 'Операция по выводу средств на кошелек Perfect Money';
                UserHistory::addToHistory($em, $user->getId(), $amount, $message);
                $em->flush();

                return $this->render('MainMainBundle::balance.html.twig', array(
                    'err_cash' => "Операция по выводу средств на кошелек Perfect Money на сумму ".$amount.'$ успешно проведена!!!'));

            }
        }
        return $this->render('MainMainBundle::balance.html.twig', array(
            'err_cash' => "На вашем счету, в системе, не достаточно денег!!!"));
    }

    /**
     * @Route("/user/balance", name="main_balance")
     * @Security("has_role('USER_ROLE')")
     * @return Response $response
     */
    public function balanceAction(Request $request) {
        return $this->render('@MainMain/balance.html.twig');
    }

    /**
     * @Route("/user/investMoney", name="main_invest_money")
     * @Security("has_role('USER_ROLE')")
     * @return Response $response
     */
    public function investMoneyAction(Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $this->getUser();
       $AccountID =  $request->request->get('AccountID');
       $PassPhrase = $request->request->get('PassPhrase');
       $Amount = $request->request->get('Amount');
        $f=fopen('https://perfectmoney.is/acct/balance.asp?AccountID='.$AccountID.'&PassPhrase='.$PassPhrase, 'rb');
        if($f===false){
            return $this->render('MainMainBundle::balance.html.twig'
                , array(
                    'err_cash' => "Ошыбка не правильный путь!!!"));
        }
        $out=array(); $out="";
        while(!feof($f)) $out.=fgets($f);
        fclose($f);
        if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $out, $result, PREG_SET_ORDER)){
            return $this->render('MainMainBundle::balance.html.twig'
                , array(
                    'err_cash' => "Не пытайтесь нас взламать - это наказывается законом!!!"));
        }
        $ar="";
        foreach($result as $item){
            $key=$item[1];
            $ar[$key]=$item[2];
        }
        if(array_key_exists('ERROR',$ar))
        {
            if($ar['ERROR'] == 'Can not login with passed AccountID and PassPhrase')
            {
                return $this->render('MainMainBundle::balance.html.twig'
                    , array(
                        'err_cash' => 'Не правильный пароль или логин'));
            }
            else {
                return $this->render('MainMainBundle::balance.html.twig'
                    , array(
                        'err_cash' => $ar['ERROR']));
            }
         }
        else
        {
            $payer_Account = $user->getPerfectMoney(); //акаунт перфект моней
            $content_Account = $ar[$payer_Account]; //содержымое аккаунта
            $payee = AdminRecord::getGlobalWallet($em) ;
            $payee_Account = $payee['Wallet'];//счет глобального кошелька
            $payment_id = rand(1,9999);
            $f_invest=fopen('https://perfectmoney.is/acct/confirm.asp?'
                . 'AccountID=' . $AccountID . '&'
                . 'PassPhrase=' . $PassPhrase . '&'
                .'Payer_Account=' . $payer_Account . '&'
                . 'Payee_Account=' . $payee_Account . '&'
                . 'Amount='.$Amount . '&'
                . 'PAY_IN=1&'
                . 'PAYMENT_ID=' . $payment_id, 'rb');

            if($f_invest===false)
                {
                    echo 'error openning url';
                }
            $out_invest=array(); $out_invest="";
            while(!feof($f_invest)) $out_invest.=fgets($f_invest);
            fclose($f_invest);
            if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $out_invest, $result_invest, PREG_SET_ORDER))
                {
                    echo 'Ivalid output';
                    exit;
                }
            $ar_invest="";
            foreach($result_invest as $item_invest)
                {
                    $key_invest=$item_invest[1];
                    $ar_invest[$key_invest]=$item_invest[2];
                }
            if(array_key_exists('ERROR',$ar_invest))
            {
                if($ar_invest['ERROR'] == 'Not enough money to pay')
                {
                    return $this->render('MainMainBundle::balance.html.twig'
                        , array(
                            'err_cash' => 'Не достаточно средств на счету, пожалуйста пополните свой счет с учотом комиссии!!!'));
                }
                else {
                    return $this->render('MainMainBundle::balance.html.twig'
                        , array(
                            'err_cash' => $ar_invest['ERROR']));
                }
            }
            else
            {
              $balance = $user->getWallet()->getBalance();
                $balance = $balance + $Amount;
                $user->getWallet()->setBalance($balance);
                AdminRecord::addToGlobal($em,$Amount);
                $em->flush();
                return $this->render('MainMainBundle::balance.html.twig', array(
                    'err_cash' => 'Поздравляем! Вы внесли в систему '.$Amount.'$ !'));
            }
        }

    }
}
