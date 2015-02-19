<?php

namespace Main\MainBundle\Entity;

use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="statistics")
 */
class Statistics {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userid;


    protected $user;

    /**
     * @var integer
     * @ORM\Column(name="earned_money", type="integer")
     */
    private $earnedMoney;

    /**
     * @var integer
     * @ORM\Column(name="spent_money", type="integer")
     */
    private $spentMoney;

    /**
     * @var integer
     * @ORM\Column(name="people_count", type="integer")
     */
    private $peopleCount;

}