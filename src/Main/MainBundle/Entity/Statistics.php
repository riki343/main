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

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="statistics")
     * @ORM\JoinColumn(name="userid", referencedColumnName="id")
     * @var User
     */
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


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userid
     *
     * @param integer $userid
     * @return Statistics
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return integer 
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set earnedMoney
     *
     * @param integer $earnedMoney
     * @return Statistics
     */
    public function setEarnedMoney($earnedMoney)
    {
        $this->earnedMoney = $earnedMoney;

        return $this;
    }

    /**
     * Get earnedMoney
     *
     * @return integer 
     */
    public function getEarnedMoney()
    {
        return $this->earnedMoney;
    }

    /**
     * Set spentMoney
     *
     * @param integer $spentMoney
     * @return Statistics
     */
    public function setSpentMoney($spentMoney)
    {
        $this->spentMoney = $spentMoney;

        return $this;
    }

    /**
     * Get spentMoney
     *
     * @return integer 
     */
    public function getSpentMoney()
    {
        return $this->spentMoney;
    }

    /**
     * Set peopleCount
     *
     * @param integer $peopleCount
     * @return Statistics
     */
    public function setPeopleCount($peopleCount)
    {
        $this->peopleCount = $peopleCount;

        return $this;
    }

    /**
     * Get peopleCount
     *
     * @return integer 
     */
    public function getPeopleCount()
    {
        return $this->peopleCount;
    }

    /**
     * Set user
     *
     * @param \Main\MainBundle\Entity\User $user
     * @return Statistics
     */
    public function setUser(\Main\MainBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Main\MainBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->earnedMoney = 0;
        $this->spentMoney = 0;
        $this->peopleCount = 0;
    }
}
