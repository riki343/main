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
     * @param Request $request
     * @return Response $response
     */
    public function indexAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN') === false) {
            throw $this->createAccessDeniedException();
        }
        return $this->render('@MainMain/adminPanel.html.twig');
    }
}