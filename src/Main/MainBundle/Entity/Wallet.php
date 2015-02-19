<?php

namespace Main\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 * @ORM\Entity
 * @ORM\Table(name="wallet")
 */
class Wallet {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="userid", type="integer")
     */
    private $userid;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="wallet")
     * @ORM\JoinColumn(name="userid", referencedColumnName="id")
     * @var User
     */
    protected $user;

    /**
     * @var float
     *
     * @ORM\Column(name="balance", type="float")
     */
    private $balance;


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
     * @return Wallet
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
     * Set balance
     *
     * @param float $balance
     * @return Wallet
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return float 
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set user
     *
     * @param \Main\MainBundle\Entity\User $user
     * @return Wallet
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
        $this->balance = 0;
    }
}
