<?php

namespace Main\MainBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;

/**
 * Matrix
 * @ORM\Entity
 * @ORM\Table(name="user_history")
 */
class UserHistory
{
    /**
     * @var integer $id
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime $date
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="userid", type="integer")
     */
    private $userid;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="history")
     * @ORM\JoinColumn(name="userid", referencedColumnName="id")
     * @var User
     */
    protected $user;

    /**
     * @var string $description
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var float $balanceBefore
     * @ORM\Column(name="balance_before", type="float")
     */
    private $balanceBefore;

    /**
     * @var float $balanceAfter
     * @ORM\Column(name="balance_after", type="float")
     */
    private $balanceAfter;

    /**
     * @var float $ammount
     * @ORM\Column(name="ammount", type="float")
     */
    private $ammount;

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
     * Set date
     *
     * @param integer $date
     * @return UserHistory
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return integer 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return UserHistory
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set balanceBefore
     *
     * @param float $balanceBefore
     * @return UserHistory
     */
    public function setBalanceBefore($balanceBefore)
    {
        $this->balanceBefore = $balanceBefore;

        return $this;
    }

    /**
     * Get balanceBefore
     *
     * @return float 
     */
    public function getBalanceBefore()
    {
        return $this->balanceBefore;
    }

    /**
     * Set balanceAfter
     *
     * @param float $balanceAfter
     * @return UserHistory
     */
    public function setBalanceAfter($balanceAfter)
    {
        $this->balanceAfter = $balanceAfter;

        return $this;
    }

    /**
     * Get balanceAfter
     *
     * @return float 
     */
    public function getBalanceAfter()
    {
        return $this->balanceAfter;
    }

    /**
     * Set ammount
     *
     * @param float $ammount
     * @return UserHistory
     */
    public function setAmmount($ammount)
    {
        $this->ammount = $ammount;

        return $this;
    }

    /**
     * Get ammount
     *
     * @return float 
     */
    public function getAmmount()
    {
        return $this->ammount;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->date = new \DateTime();
    }

    /**
     * Set userid
     *
     * @param integer $userid
     * @return UserHistory
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
     * Set user
     *
     * @param \Main\MainBundle\Entity\User $user
     * @return UserHistory
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
     * Add user
     *
     * @param \Main\MainBundle\Entity\User $user
     * @return UserHistory
     */
    public function addUser(\Main\MainBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Main\MainBundle\Entity\User $user
     */
    public function removeUser(\Main\MainBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * @param EntityManager $em
     * @param int $user_id
     * @param float $ammount
     * @param string $message
     */
    public static function addToHistory(EntityManager $em, $user_id, $ammount, $message) {
        $user = $em->getRepository('MainMainBundle:User')->find($user_id);

        $history = new UserHistory();
        $history->setUser($user);
        $history->setBalanceBefore($user->getWallet()->getBalance());
        $history->setAmmount($ammount);
        $history->setBalanceAfter($user->getWallet()->getBalance() + $ammount);
        $history->setDescription($message);

        $em->persist($history);
    }
}
