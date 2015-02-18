<?php

namespace Main\MainBundle\Services;

use Doctrine\ORM\Mapping as ORM;
//use Main\MainBundle\Entity\Notification;
//use Main\MainBundle\Entity\Message;
use Main\MainBundle\Entity\User;

class Notifier {
    private $user = null;
    private $em = null;
    private $router = null;
    private $mailer = null;
}