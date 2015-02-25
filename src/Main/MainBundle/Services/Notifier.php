<?php

namespace Main\MainBundle\Services;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Main\MainBundle\Entity\Notification;
use Main\MainBundle\Entity\User;

class Notifier {
    private $user = null;
    /** @var EntityManager $em */
    private $em;
    private $router = null;
    private $mailer = null;

    public function __construct($securityContext, $em, $router, $mailer)
    {
        $this->user = $securityContext->getToken()->getUser();
        $this->em = $em;
        $this->router = $router;
        $this->mailer = $mailer;
    }

    /**
     * @param $myEmail
     * @param $message
     * @param $subject
     */
    public function sendNotificationToEmail($myEmail, $message, $subject)
    {
        try {
            $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom('support@easytoinvest.net')
                ->setTo($myEmail)
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
        $user = $this->em->getRepository('MainMainBundle:User')->find($user_id);
        $notification = new Notification();
        $notification->setUser($user);
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