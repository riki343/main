<?php

namespace Main\MainBundle\Controller;

use Main\MainBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;

// @Route \\
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
// @Security \\
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Main\MainBundle\Extras\ChromePhp as console;

class UserController extends Controller {

    public function indexAction(Request $request) {
        $user = $this->getUser();
        return $this->render('MainMainBundle::userpage.html.twig');
    }

    /**
     * @Route("/user/statistics", name="main_userpage_statistics")
     * @Security("has_role('USER_ROLE')")
     */
    public function statisticsAction(Request $request)
    {
        return $this->render('MainMainBundle::statistics.html.twig');
    }

    /**
     * @Route("/user/activateAcount", name="main_activate_acount")
     * @Security("has_role('USER_ROLE')")
     */
    public function activateAcountAction()
    {
        $user = $this ->getUser();
        $userId = $user->getId();
        $parrentId = $user -> getSponsorid();
        console::log('$userId',$userId);
        console::log('$parrentId',$parrentId);
        console::log('succses');
        return $this->render('MainMainBundle::userpage.html.twig');
    }
}
