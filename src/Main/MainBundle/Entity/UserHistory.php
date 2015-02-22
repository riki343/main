<?php

namespace Main\MainBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Main\MainBundle\Extras\ChromePhp as console;

/**
 * Matrix
 * @ORM\Entity
 * @ORM\Table(name="user_history")
 */
class UserHistory
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
    private $date;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    private $ballanceBefore;
}