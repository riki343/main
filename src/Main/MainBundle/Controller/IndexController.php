<?php

namespace Main\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('MainMainBundle:Default:index.html.twig');
    }
}
