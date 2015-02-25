<?php

namespace Main\MainBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;

/**
 * AdminRecord
 * @ORM\Entity
 * @ORM\Table(name="admin_record")
 */
class AdminRecord {
    /**
     * @var integer $id
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float $investedMoney
     * @ORM\Column(name="invested_money", type="float", options={"default":0})
     */
    private $investedMoney;

    /**
     * @var float $spentMoney
     * @ORM\Column(name="spent_money", type="float", options={"default":0})
     */
    private $spentMoney;

    /**
     * @var int $userCount
     * @ORM\Column(name="user_count", type="integer", options={"default":0})
     */
    private $userCount;

    /**
     * @var int $activeUserCount
     * @ORM\Column(name="active_user_count", type="integer", options={"default":0})
     */
    private $activeUserCount;

    /**
     * @var int $earnedMoney
     * @ORM\Column(name="earned_money", type="integer", options={"default":0})
     */
    private $earnedMoney;

    /**
     * @var float $earnedMoney
     * @ORM\Column(name="system_balance", type="float", options={"default":0})
     */
    private $systemBalance;

    /**
     * @var string
     *
     * @ORM\Column(name="perfect_money", type="string", length=8, unique=true)
     */
    private $perfectMoney;

    /**
     * @var string
     *
     * @ORM\Column(name="perfect_money_id", type="string", length=100, unique=true)
     */
    private $perfectMoneyID;

    /**
     * @var string
     *
     * @ORM\Column(name="perfect_money_pass", type="string", length=100, unique=true)
     */
    private $perfectMoneyPass;

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
     * Set investedMoney
     *
     * @param float $investedMoney
     * @return AdminRecord
     */
    public function setInvestedMoney($investedMoney)
    {
        $this->investedMoney = $investedMoney;

        return $this;
    }

    /**
     * Get investedMoney
     *
     * @return float 
     */
    public function getInvestedMoney()
    {
        return $this->investedMoney;
    }

    /**
     * Set spentMoney
     *
     * @param float $spentMoney
     * @return AdminRecord
     */
    public function setSpentMoney($spentMoney)
    {
        $this->spentMoney = $spentMoney;
        return $this;
    }

    /**
     * Get spentMoney
     *
     * @return float 
     */
    public function getSpentMoney()
    {
        return $this->spentMoney;
    }

    /**
     * Set userCount
     *
     * @param integer $userCount
     * @return AdminRecord
     */
    public function setUserCount($userCount)
    {
        $this->userCount = $userCount;

        return $this;
    }

    /**
     * Get userCount
     *
     * @return integer 
     */
    public function getUserCount()
    {
        return $this->userCount;
    }

    /**
     * Set activeUserCount
     *
     * @param integer $activeUserCount
     * @return AdminRecord
     */
    public function setActiveUserCount($activeUserCount)
    {
        $this->activeUserCount = $activeUserCount;

        return $this;
    }

    /**
     * Get activeUserCount
     *
     * @return integer 
     */
    public function getActiveUserCount()
    {
        return $this->activeUserCount;
    }

    /**
     * Set earnedMoney
     *
     * @param integer $earnedMoney
     * @return AdminRecord
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
     * Set systemBalance
     *
     * @param float $systemBalance
     * @return AdminRecord
     */
    public function setSystemBalance($systemBalance)
    {
        $this->systemBalance = $systemBalance;

        return $this;
    }

    /**
     * Get systemBalance
     *
     * @return float 
     */
    public function getSystemBalance()
    {
        return $this->systemBalance;
    }

    /**
     * Set perfectMoney
     *
     * @param string $perfectMoney
     * @return AdminRecord
     */
    public function setPerfectMoney($perfectMoney)
    {
        $this->perfectMoney = $perfectMoney;

        return $this;
    }

    /**
     * Get perfectMoney
     *
     * @return string 
     */
    public function getPerfectMoney()
    {
        return $this->perfectMoney;
    }

    /**
     * Set perfectMoneyID
     *
     * @param string $perfectMoneyID
     * @return AdminRecord
     */
    public function setPerfectMoneyID($perfectMoneyID)
    {
        $this->perfectMoneyID = $perfectMoneyID;

        return $this;
    }

    /**
     * Get perfectMoneyID
     *
     * @return string 
     */
    public function getPerfectMoneyID()
    {
        return $this->perfectMoneyID;
    }

    /**
     * Set perfectMoneyPass
     *
     * @param string $perfectMoneyPass
     * @return AdminRecord
     */
    public function setPerfectMoneyPass($perfectMoneyPass)
    {
        $this->perfectMoneyPass = $perfectMoneyPass;

        return $this;
    }

    /**
     * Get perfectMoneyPass
     *
     * @return string 
     */
    public function getPerfectMoneyPass()
    {
        return $this->perfectMoneyPass;
    }

    /**
     * @param EntityManager $em
     * @param float $ammount
     */
    public static function addToGlobal(EntityManager $em, $ammount) {
        $global = $em->getRepository('MainMainBundle:AdminRecord')->find(1);
        $global->systemBalance += $ammount;
        $global->earnedMoney += $ammount;
        $global->investedMoney += $ammount;
        $em->flush();
    }

    /**
     * @param EntityManager $em
     * @param float $ammount
     */
    public static function removeFromGlobal(EntityManager $em, $ammount) {
        $global = $em->getRepository('MainMainBundle:AdminRecord')->find(1);
        $global->systemBalance -= $ammount;
        $global->spentMoney += $ammount;
        $em->flush();
    }

    /**
     * @param EntityManager $em
     * @return array
     */
    public static function getGlobalWallet(EntityManager $em) {
        $global = $em->getRepository('MainMainBundle:AdminRecord')->find(1);
        $mas = array();
        $mas['AccountID'] = $global->perfectMoneyID;
        $mas['PassPhrase'] = $global->perfectMoneyPass;
        $mas['Wallet'] = $global->perfectMoney;
        return $mas;
    }

    /**
     * @param EntityManager $em
     * @return AdminRecord
     */
    public static function getAdminWallet(EntityManager $em) {
        return $em->getRepository('MainMainBundle:AdminRecord')->find(1);
    }

    /**
     * @param EntityManager $em
     */
    public static function addNewUser(EntityManager $em) {
        $global = $em->getRepository('MainMainBundle:AdminRecord')->find(1);
        $global->userCount++;
        $em->flush();
    }

    /**
     * @param EntityManager $em
     */
    public static function addNewActiveUser(EntityManager $em) {
        $global = $em->getRepository('MainMainBundle:AdminRecord')->find(1);
        $global->activeUserCount++;
        $em->flush();
    }
}
