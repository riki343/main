<?php

namespace Main\MainBundle\Services;

use Doctrine\ORM\Mapping as ORM;
//use Main\MainBundle\Entity\Notification;
//use Main\MainBundle\Entity\Message;
use Main\MainBundle\Entity\Notification;
use Main\MainBundle\Entity\User;

class Notifier {
    private $user = null;
    private $em = null;
    private $router = null;
    private $mailer = null;

    public function __construct($securityContext, $em, $router, $mailer)
    {
        $this->user = $securityContext->getToken()->getUser();
        $this->em = $em;
        $this->router = $router;
        $this->mailer = $mailer;
    }

    public function sendNotificationToEmail($user, $message)
    {
        try {
            $message = \Swift_Message::newInstance()
                ->setSubject('notification!')
                ->setFrom('support@main.com')
                ->setTo($user->getEmail())
                ->setBody($message, 'text/html');
            $this->mailer->send($message);
        } catch (\Swift_RfcComplianceException $ex) {  }
    }

    /**
     * @param int $user_id
     * @param string $message
     */
    public function createNotification($user_id, $message)
    {
        $notification = new Notification();
        $notification->setUserid($user_id);
        $notification->setMessage($message);
        $notification->setActive(false);
        $notification->setRegistered(new \DateTime());
        $this->em->persist($notification);
		$this->em->flush();

        //$this->sendNotificationToEmail($newUser, $message);
    }

    public function clearNotifications()
    {
        $notifications = $this->em->getRepository('MainMainBundle:Notification')
            ->findBy(array('active' => true));
        if ($notifications == null) return;
        foreach($notifications as $notification) {
            $this->em->remove($notification);
        }
        $this->em->flush();
    }
}