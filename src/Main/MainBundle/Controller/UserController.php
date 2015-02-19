<?php

namespace Main\MainBundle\Controller;

use Main\MainBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Main\MainBundle\Extras\ChromePhp as console;

class UserController extends Controller {

    public function indexAction(Request $request) {
        $user = $this->getUser();
        return $this->render('MainMainBundle::userpage.html.twig');
    }

    public function statisticsAction(Request $request)
    {
        return $this->render('MainMainBundle::statistics.html.twig');
    }
}
