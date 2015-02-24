<?php

namespace Main\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KeysForAccess
 *
 * @ORM\Table(name="keys_for_access")
 * @ORM\Entity
 */
class KeysForAccess
{
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
     * @var string
     *
     * @ORM\Column(name="keyForForgotPassword", type="text", nullable=true, options={"default":NULL})
     */
    private $keyForForgotPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="keyForPerfectMoney", type="text", nullable=true, options={"default":NULL})
     */
    private $keyForPerfectMoney;

    /**
     * @var string
     *
     * @ORM\Column(name="keyForConfirmAccount", type="text", nullable=true, options={"default":NULL})
     */
    private $keyForConfirmAccount;

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
     * @return KeysForAccess
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
     * Set keyForForgotPassword
     *
     * @param string $keyForForgotPassword
     * @return KeysForAccess
     */
    public function setKeyForForgotPassword($keyForForgotPassword)
    {
        $this->keyForForgotPassword = $keyForForgotPassword;

        return $this;
    }

    /**
     * Get keyForForgotPassword
     *
     * @return string 
     */
    public function getKeyForForgotPassword()
    {
        return $this->keyForForgotPassword;
    }

    /**
     * Set keyForPerfectMoney
     *
     * @param string $keyForPerfectMoney
     * @return KeysForAccess
     */
    public function setKeyForPerfectMoney($keyForPerfectMoney)
    {
        $this->keyForPerfectMoney = $keyForPerfectMoney;

        return $this;
    }

    /**
     * Get keyForPerfectMoney
     *
     * @return string 
     */
    public function getKeyForPerfectMoney()
    {
        return $this->keyForPerfectMoney;
    }

    /**
     * Set keyForConfirmAccount
     *
     * @param string $keyForConfirmAccount
     * @return KeysForAccess
     */
    public function setKeyForConfirmAccount($keyForConfirmAccount)
    {
        $this->keyForConfirmAccount = $keyForConfirmAccount;

        return $this;
    }

    /**
     * Get keyForConfirmAccount
     *
     * @return string 
     */
    public function getKeyForConfirmAccount()
    {
        return $this->keyForConfirmAccount;
    }


    /**
     * @param $em
     * @param $user
     * @return string
     */
    public static function addKeyForPerfectMoney($em, $user)
    {
        $newRecord = new KeysForAccess();

        $datetime = new \DateTime();
        srand($datetime->format('s'));
        $keyForAccess = md5(rand(1000, 100000));

        $newRecord->setUserid($user->getId());
        $newRecord->setKeyForPerfectMoney($keyForAccess);
        $em->persist($newRecord);
        $em->flush();

        return $keyForAccess;
    }
}
