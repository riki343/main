<?php

namespace Main\MainBundle\Controller;

use Doctrine\ORM\EntityManager;
use Main\MainBundle\Entity\AdminRecord;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="main_admin_panel")
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response $response
     */
    public function indexAction() {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN') === false) {
            throw $this->createAccessDeniedException();
        }

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var AdminRecord $global */
        $adminRecord = AdminRecord::getAdminWallet($em);

        return $this->render('@MainMain/adminPanel.html.twig', array('adminRecord' => $adminRecord));
    }

    /**
     * @Route("/admin/change_perfect_money", name="main_admin_change_perfect_money")
     * @Security("has_role('ROLE_ADMIN')")
     * @param Request $request
     */
    public function changePerfectMoneySettingsAction(Request $request) {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN') === false) {
            throw $this->createAccessDeniedException();
        } else if ($request->getMethod() != 'POST') {
            return new Response('Only "POST" method allowed!');
        }

        $id = $request->request->get('id');
        $pass = $request->request->get('pass');
        $wallet = $request->request->get('wallet');

        if (!$id) {
            return $this->render('@MainMain/adminPanel.html.twig', array('error' => 1));
        } else if (!$pass) {
            return $this->render('@MainMain/adminPanel.html.twig', array('error' => 2));
        } else if (!$wallet) {
            return $this->render('@MainMain/adminPanel.html.twig', array('error' => 3));
        }

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var AdminRecord $global */
        $global = AdminRecord::getAdminWallet($em);

        $global->setPerfectMoneyID($id);
        $global->setPerfectMoneyPass($pass);
        $global->setPerfectMoney($wallet);

        $em->persist($global);
        $em->flush();


        return $this->render('@MainMain/adminPanel.html.twig',
            array('adminRecord' => $global, 'success' => 1));
    }
}