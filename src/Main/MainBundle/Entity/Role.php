<?php

namespace Main\MainBundle\Entity;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="roles")
 */
class Role implements RoleInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    public function getRole()
    {
        return $this->getName();
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
     * Set name
     *
     * @param string $name
     * @return Role
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userRoles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add userRoles
     *
     * @param \Main\MainBundle\Entity\Role $userRoles
     * @return Role
     */
    public function addUserRole(\Main\MainBundle\Entity\Role $userRoles)
    {
        $this->userRoles[] = $userRoles;

        return $this;
    }

    /**
     * Remove userRoles
     *
     * @param \Main\MainBundle\Entity\Role $userRoles
     */
    public function removeUserRole(\Main\MainBundle\Entity\Role $userRoles)
    {
        $this->userRoles->removeElement($userRoles);
    }

    /**
     * Get userRoles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserRoles()
    {
        return $this->userRoles;
    }

    /**
     * @param EntityManager $em
     * @return Role
     */
    public static function getUserRole(EntityManager $em) {
        return $em->getRepository('MainMainBundle:Role')->find(1);
    }

    /**
     * @param EntityManager $em
     * @return Role
     */
    public static function getAdminRole(EntityManager $em) {
        return $em->getRepository('MainMainBundle:Role')->find(2);
    }

    /**
     * @param EntityManager $em
     * @return Role
     */
    public static function getSuperAdminRole(EntityManager $em) {
        return $em->getRepository('MainMainBundle:Role')->find(3);
    }
}
