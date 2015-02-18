<?php

namespace Main\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Main\MainBundle\Entity\UserRepository")
 * @ORM\Table(name="users")
 */
class User implements UserInterface, \Serializable {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registered", type="datetime")
     */
    private $registered;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastactive", type="datetime")
     */
    private $lastactive;

    /**
     * @var boolean
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="perfect_money", type="string", length=8, unique=true)
     */
    private $perfectMoney;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=255)
     */
    private $avatar;

    /**
     * Get password
     *
     * @return string
     */

    /**
     * @var integer
     * @ORM\Column(name="sponsor_id", type="integer")
     */
    private $sponsorid;

    /**
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="user_role",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     *
     * @var ArrayCollection $roles
     */
    protected $roles;

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     * @return multitype:string
     */
    public function getRoles()
    {
        return $this->roles->toArray();
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return '7v8b6ghjb6834bdkjndsjb233409fjvsiu8892d';
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->password,
            $this->email,
            $this->name,
            $this->surname,
            $this->registered,
            $this->lastactive,
            $this->perfectMoney,
            $this->active
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->password,
            $this->email,
            $this->name,
            $this->surname,
            $this->registered,
            $this->lastactive,
            $this->perfectMoney,
            $this->active) = unserialize($serialized);
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
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
     * Set surname
     *
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    
        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set registered
     *
     * @param \DateTime $registered
     * @return User
     */
    public function setRegistered($registered)
    {
        $this->registered = $registered;
    
        return $this;
    }

    /**
     * Get registered
     *
     * @return \DateTime 
     */
    public function getRegistered()
    {
        return $this->registered;
    }

    /**
     * Set lastactive
     *
     * @param \DateTime $lastactive
     * @return User
     */
    public function setLastactive($lastactive)
    {
        $this->lastactive = $lastactive;
    
        return $this;
    }

    /**
     * Get lastactive
     *
     * @return \DateTime 
     */
    public function getLastactive()
    {
        return $this->lastactive;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set perfectMoney
     *
     * @param string $perfectMoney
     * @return User
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
     * Set avatar
     *
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    
        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    public static function addUser($em, $encoderFactory, $parameters)
    {
        $user = new User();
        $encoder = $encoderFactory->getEncoder($user);

        $user->setUsername($parameters['username']);
        $user->setPassword($encoder->encodePassword($parameters['password'], $user->getSalt()));
        $user->setEmail($parameters['email']);
        $user->setName($parameters['name']);
        $user->setSurname($parameters['surname']);
        $user->setRegistered(new \DateTime());
        $user->setLastactive(new \DateTime());
        $user->setActive(0);
        $user->setPerfectMoney($parameters['perfectMoney']);
        $user->setAvatar('default.png');
        $user->setSponsorid($parameters['sponsor_id']);

        $em->persist($user);
        $em->flush();
    }

    /**
     * Set sponsorid
     *
     * @param integer $sponsorid
     * @return User
     */
    public function setSponsorid($sponsorid)
    {
        $this->sponsorid = $sponsorid;

        return $this;
    }

    /**
     * Get sponsorid
     *
     * @return integer 
     */
    public function getSponsorid()
    {
        return $this->sponsorid;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userRoles = new ArrayCollection();
    }

    /**
     * Add roles
     *
     * @param \Main\MainBundle\Entity\Role $roles
     * @return User
     */
    public function addUserRole(Role $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \Main\MainBundle\Entity\Role $roles
     */
    public function removeUserRole(Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get userRoles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserRoles()
    {
        return $this->roles;
    }

    /**
     * Add roles
     *
     * @param \Main\MainBundle\Entity\Role $roles
     * @return User
     */
    public function addRole(\Main\MainBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \Main\MainBundle\Entity\Role $roles
     */
    public function removeRole(\Main\MainBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }
}
