<?php

namespace Main\MainBundle\Entity;

use Doctrine\ORM\EntityManager;
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

    private $salt;

    /**
     * @var boolean
     * @ORM\Column(name="account_active", type="boolean")
     */
    private $accountActive;

    /**
     * @ORM\OneToOne(targetEntity="Wallet", mappedBy="user")
     * @var Wallet
     */
    protected $wallet;

    /**
     * @ORM\OneToOne(targetEntity="Statistics", mappedBy="user")
     * @var Statistics
     */
    protected $statistics;

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
            $this->username,
            $this->password,
            $this->email,
            $this->name,
            $this->surname,
            $this->registered,
            $this->lastactive,
            $this->perfectMoney,
            $this->active,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
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
        $user->setAvatar('files/default/default-avatar.png');
        $user->setSponsorid($parameters['sponsor_id']);
        $user->setAccountActive(false);

        $em->persist($user);
        $em->flush();
    }

    public static function getChild(EntityManager $em, $userid)
    {
        $numberChild = array();
        $child = $em->getRepository('MainMainBundle:User')->findBy(array('sponsorid' => $userid));
        if ($child == null) return $numberChild;
        foreach($child as $ch)
        {
            $temp = $em->getRepository('MainMainBundle:Statistics')->findOneBy(array('userid' => $ch->getId()));
            $numberChild[] = $temp->getPeopleCount();
        }
        return $numberChild;
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
        $this->roles = new ArrayCollection();
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
    public function addRole(Role $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \Main\MainBundle\Entity\Role $roles
     */
    public function removeRole(Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Set accountActive
     *
     * @param boolean $accountActive
     * @return User
     */
    public function setAccountActive($accountActive)
    {
        $this->accountActive = $accountActive;

        return $this;
    }

    /**
     * Get accountActive
     *
     * @return boolean 
     */
    public function getAccountActive()
    {
        return $this->accountActive;
    }

    /**
     * Set wallet
     *
     * @param \Main\MainBundle\Entity\Wallet $wallet
     * @return User
     */
    public function setWallet(Wallet $wallet = null)
    {
        $this->wallet = $wallet;

        return $this;
    }

    /**
     * Get wallet
     *
     * @return \Main\MainBundle\Entity\Wallet 
     */
    public function getWallet()
    {
        return $this->wallet;
    }

    /**
     * Set statistics
     *
     * @param \Main\MainBundle\Entity\Statistics $statistics
     * @return User
     */
    public function setStatistics(Statistics $statistics = null)
    {
        $this->statistics = $statistics;

        return $this;
    }

    /**
     * Get statistics
     *
     * @return \Main\MainBundle\Entity\Statistics 
     */
    public function getStatistics()
    {
        return $this->statistics;
    }
}
