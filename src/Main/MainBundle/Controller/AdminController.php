<?php

namespace Main\MainBundle\Controller;

use Doctrine\ORM\EntityManager;
use Main\MainBundle\Entity\Matrix;
use Main\MainBundle\Entity\User;
use Main\MainBundle\Entity\UserHistory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;

// |@Route| \\
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
// |@Security| \\
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Main\MainBundle\Extras\ChromePhp as console;
use Symfony\Component\HttpFoundation\Response;


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