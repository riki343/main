<?php

namespace Main\MainBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Main\MainBundle\Extras\ChromePhp as console;

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
     * @ORM\Column(name="child_0", type="array")
     */
    private $childs_0;

    /**
     * @ORM\Column(name="child_1", type="array")
     */
    private $childs_1;

    /**
     * @ORM\Column(name="child_2", type="array")
     */
    private $childs_2;

    /**
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
     * @param int $max
     */
    public function __construct($max = 1)
    {
        $this->childs_0 = array();
        $this->childs_1 = array();
        $this->childs_2 = array();
        $this->childs_3 = array();
        $this->setMaxCount($max);
        $this->setUserCount(0);
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
     * @param int $user_id
     */
    public function addToChilds0($user_id) {
        $this->childs_0[] = $user_id;
    }

    /**
     * @param int $user_id
     */
    public function addToChilds1($user_id) {
        $this->childs_1[] = $user_id;
    }

    /**
     * @param int $user_id
     */
    public function addToChilds2($user_id) {
        $this->childs_2[] = $user_id;
    }

    /**
     * @param int $user_id
     */
    public function addToChilds3($user_id) {
        $this->childs_3[] = $user_id;
        if (count($this->childs_3) == $this->getMaxCount()) {
            $this->setFull(true);
        }
    }

    /**
     * @param int $user_id
     */
    public function removeFromChilds0($user_id) {
        $indx = array_search($user_id, $this->childs_0, true);
        unset($this->childs_0[$indx]);
    }

    /**
     * @param int $user_id
     */
    public function removeFromChilds1($user_id) {
        $indx = array_search($user_id, $this->childs_1, true);
        unset($this->childs_1[$indx]);
    }

    /**
     * @param int $user_id
     */
    public function removeFromChilds2($user_id) {
        $indx = array_search($user_id, $this->childs_2, true);
        unset($this->childs_2[$indx]);
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

    /**
     * @param EntityManager $em
     * @param int $child_id
     * @param int $level
     */
    public static function addChildToUser(EntityManager $em, $child_id, $level) {

        $level = $em->getRepository('MainMainBundle:Matrix')->find($level);
        $nextLevel = $em->getRepository('MainMainBundle:Matrix')->find($level->getId() + 1);
        $user = $em->getRepository('MainMainBundle:User')->find($child_id);

        if ($nextLevel == null) {
            $nextLevel = new Matrix($level->getMaxCount() * 3);
            $nextLevel->addToChilds0($child_id);
            $nextLevel->setUserCount(1);
            $em->persist($nextLevel);
        } else {
            $nextLevel->addToChilds0($child_id);
            $nextLevel->setUserCount($nextLevel->getUserCount() + 1);
        }

        if (count($level->getChilds0()) > 0) {
            $array = $level->getChilds0();
            $sponsor_id = array_shift($array);
            $level->setChilds0($array);
            $level->addToChilds1($sponsor_id);
            $user->setSponsorid($sponsor_id);
        } else if (count($level->getChilds1()) > 0) {
            $array = $level->getChilds1();
            $sponsor_id = array_shift($array);
            $level->setChilds1($array);
            $level->addToChilds2($sponsor_id);
            $user->setSponsorid($sponsor_id);
        } else if (count($level->getChilds2()) > 0) {
            $array = $level->getChilds2();
            $sponsor_id = array_shift($array);
            $level->setChilds2($array);
            $level->addToChilds3($sponsor_id);
            $user->setSponsorid($sponsor_id);
            if (count($level->getChilds3()) == $level->getMaxCount()) {
                $level->setFull(true);
            }
        }

        $em->flush();
    }

    /**
     * @param EntityManager $em
     * @return Matrix
     */
    public static function getNotFullLevel(EntityManager $em) {
        $level = $em->getRepository('MainMainBundle:Matrix')->findOneBy(array('full' => false));
        return $level;
    }
}
