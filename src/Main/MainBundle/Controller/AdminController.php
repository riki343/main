<?php

namespace Main\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="main_admin_panel")
     * @Security("has_role('ADMIN_ROLE')")
     * @return Response $response
     */
    public function indexAction() {
        $adminRecord = $this->getDoctrine()->getRepository('MainMainBundle:AdminRecord')->find(1);
        return $this->render('@MainMain/adminPanel.html.twig', array('adminRecord' => $adminRecord));
    }
}