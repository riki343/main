<?php

namespace Main\MainBundle\Controller;

use Main\MainBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {
    public function indexAction() {
        return $this->render('MainMainBundle::userpage.html.twig');
    }
}
