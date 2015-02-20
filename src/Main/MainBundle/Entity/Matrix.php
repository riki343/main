<?php

namespace Main\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Matrix
 * @ORM\Entity
 * @ORM\Table(name="matrix")
 */
class Matrix
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $maxCount
     *
     * @ORM\Column(name="max_count", type="integer")
     */
    private $maxCount;

    /**
     * @var ArrayCollection $childs_0
     * @ORM\Column(name="child_0", type="array")
     */
    private $childs_0;

    /**
     * @var ArrayCollection $childs_1
     * @ORM\Column(name="child_1", type="array")
     */
    private $childs_1;

    /**
     * @var ArrayCollection $childs_2
     * @ORM\Column(name="child_2", type="array")
     */
    private $childs_2;

    /**
     * @var ArrayCollection $childs_3
     * @ORM\Column(name="child_3", type="array")
     */
    private $childs_3;

    /**
     * @var boolean $full
     * @ORM\Column(name="full", type="boolean")
     */
    private $full;

    /**
     * @var integer $userCount
     *
     * @ORM\Column(name="user_count", type="integer")
     */
    private $userCount;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->childs_0 = new ArrayCollection();
        $this->childs_1 = new ArrayCollection();
        $this->childs_2 = new ArrayCollection();
        $this->childs_3 = new ArrayCollection();
        $this->full = false;
    }

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
     * Set maxCount
     *
     * @param integer $maxCount
     * @return Matrix
     */
    public function setMaxCount($maxCount)
    {
        $this->maxCount = $maxCount;

        return $this;
    }

    /**
     * Get maxCount
     *
     * @return integer 
     */
    public function getMaxCount()
    {
        return $this->maxCount;
    }

    /**
     * Set childs_0
     *
     * @param array $childs0
     * @return Matrix
     */
    public function setChilds0($childs0)
    {
        $this->childs_0 = $childs0;

        return $this;
    }

    /**
     * Get childs_0
     *
     * @return array 
     */
    public function getChilds0()
    {
        return $this->childs_0;
    }

    /**
     * Set childs_1
     *
     * @param array $childs1
     * @return Matrix
     */
    public function setChilds1($childs1)
    {
        $this->childs_1 = $childs1;

        return $this;
    }

    /**
     * Get childs_1
     *
     * @return array 
     */
    public function getChilds1()
    {
        return $this->childs_1;
    }

    /**
     * Set childs_2
     *
     * @param array $childs2
     * @return Matrix
     */
    public function setChilds2($childs2)
    {
        $this->childs_2 = $childs2;

        return $this;
    }

    /**
     * Get childs_2
     *
     * @return array 
     */
    public function getChilds2()
    {
        return $this->childs_2;
    }

    /**
     * Set childs_3
     *
     * @param array $childs3
     * @return Matrix
     */
    public function setChilds3($childs3)
    {
        $this->childs_3 = $childs3;

        return $this;
    }

    /**
     * Get childs_3
     *
     * @return array 
     */
    public function getChilds3()
    {
        return $this->childs_3;
    }

    /**
     * Set full
     *
     * @param boolean $full
     * @return Matrix
     */
    public function setFull($full)
    {
        $this->full = $full;

        return $this;
    }

    /**
     * Get full
     *
     * @return boolean 
     */
    public function getFull()
    {
        return $this->full;
    }

    /**
     * Set userCount
     *
     * @param integer $userCount
     * @return Matrix
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
}
