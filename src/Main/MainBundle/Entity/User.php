<?php

namespace Main\MainBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Main\MainBundle\Services\Notifier;
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
     * @var integer
     * @ORM\Column(name="sponsor_id", type="integer", nullable=true, options={"default":NULL})
     */
    private $sponsorid;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="sponsor_id", referencedColumnName="id")
     * @var User
     */
    protected $sponsor;

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
     * @ORM\OrderBy({"id" = "DESC"})
     * @var Statistics
     */
    protected $statistics;

    /**
     * @ORM\OneToMany(targetEntity="UserHistory", mappedBy="user")
     * @ORM\OrderBy({"id" = "DESC"})
     * @var UserHistory
     */
    protected $history;

    /**
     * @ORM\OneToMany(targetEntity="Notification", mappedBy="user")
     * @ORM\OrderBy({"id" = "DESC"})
     * @var Notification
     */
    protected $notifications;

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     * @return ArrayCollection
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
            $this->username,
            $this->password,
            $this->email,
            $this->name,
            $this->registered,
            $this->lastactive,
            $this->perfectMoney,
            $this->active
        ) = unserialize($serialized);
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

    /**
     * @param EntityManager $em
     * @param $encoderFactory
     * @param $parameters
     */
    public static function addUser(EntityManager $em, $encoderFactory, $parameters)
    {
        $user = new User();
        $encoder = $encoderFactory->getEncoder($user);

        $user->setUsername($parameters['username']);
        $user->setPassword($encoder->encodePassword($parameters['password'], $user->getSalt()));
        $user->setEmail($parameters['email']);
        $user->setName($parameters['name']);
        $user->setRegistered(new \DateTime());
        $user->setLastactive(new \DateTime());
        $user->setActive(false);
        $user->setPerfectMoney(strtoupper($parameters['perfectMoney']));
        $user->setAvatar('files/default/default-avatar.png');
        $user->setAccountActive(false);

        $user->addRole(Role::getUserRole($em));

        $wallet = new Wallet();
        $user->setWallet($wallet);

        $statistics = new Statistics();
        $user->setStatistics($statistics);

        $em->persist($user);

        $wallet->setUser($user);
        $em->persist($wallet);

        $statistics->setUser($user);
        $em->persist($statistics);
        $em->flush();
    }

    /**
     * @param EntityManager $em
     * @param $userid
     * @return array
     */
    public static function getChild($em, $userid)
    {
        $child = $em->getRepository('MainMainBundle:User')->findBy(array('sponsorid' => $userid));
        return $child;
    }

    /**
     * @param EntityManager $em
     * @param $encoderFactory
     * @param $user
     * @param $parameters
     * @return integer
     */
    public static function changePassword($em, $encoderFactory, User $user, $parameters)
    {
        $encoder = $encoderFactory->getEncoder($user);
        $encodedPassword = $encoder->encodePassword($parameters['currentPassword'], $user->getSalt());
        if ($encodedPassword != $user->getPassword())
            return 0;
        if ($parameters['newPassword'] != $parameters['repeatNewPassword'])
            return 1;
        $usr = $em->getRepository('MainMainBundle:User')->find($user->getId());
        $newPassword = $encoder->encodePassword($parameters['newPassword'], $user->getSalt());
        $usr->setPassword($newPassword);
        $em->flush();
        return 2;
    }

    /**
     * @param EntityManager $em
     * @param User $user
     * @param $newPerfectMoney
     * @return int
     */
    public static function changePerfectMoney($em, $user, $newPerfectMoney)
    {
        if (strlen($newPerfectMoney) != 8)
            return 0;

        $usr = $em->getRepository('MainMainBundle:User')->find($user->getId());
        $usr->setPerfectMoney(strtoupper($newPerfectMoney));
        $em->flush();
        return 1;
    }

    /**
     * @param EntityManager $em
     * @param $userid
     */
    public static function confirmEmail($em, $userid)
    {
        $user = $em->getRepository('MainMainBundle:User')->find($userid);
        $user->setActive(true);
        $em->flush();
    }

    /**
     * @param EntityManager $em
     * @param $encoderFactory
     * @param User $user
     * @param $parameters
     * @return int
     */
    public static function forgotPassword($em, $encoderFactory, $user, $parameters)
    {
        $encoder = $encoderFactory->getEncoder($user);
        $encodedPassword = $encoder->encodePassword($parameters['currentPassword'], $user->getSalt());
        if ($encodedPassword != $user->getPassword())
            return 0;
        if ($parameters['newPassword'] != $parameters['repeatNewPassword'])
            return 1;
        $usr = $em->getRepository('IntranetMainBundle:User')->find($user->getId());
        $newPassword = $encoder->encodePassword($parameters['newPassword'], $user->getSalt());
        $usr->setPassword($newPassword);
        $em->flush();
        return 2;
    }

    /**
     * @param EntityManager $em
     * @param $encoderFactory
     * @param User $user
     * @param $parameters
     * @return int
     */
    public static function resetPassword($em, $encoderFactory, $user, $parameters)
    {
        if ($parameters['newPassword'] != $parameters['repeatNewPassword'])
            return 0;
        $encoder = $encoderFactory->getEncoder($user);
        $usr = $em->getRepository('MainMainBundle:User')->find($user->getId());
        $newPassword = $encoder->encodePassword($parameters['newPassword'], $user->getSalt());
        $usr->setPassword($newPassword);
        $em->flush();
        return 1;
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

    /**
     * Set sponsor
     *
     * @param \Main\MainBundle\Entity\User $sponsor
     * @return User
     */
    public function setSponsor(User $sponsor = null)
    {
        $this->sponsor = $sponsor;

        return $this;
    }

    /**
     * Get sponsor
     *
     * @return \Main\MainBundle\Entity\User 
     */
    public function getSponsor()
    {
        return $this->sponsor;
    }

    /**
     * Set history
     *
     * @param \Main\MainBundle\Entity\UserHistory $history
     * @return User
     */
    public function setHistory(UserHistory $history = null)
    {
        $this->history = $history;

        return $this;
    }

    /**
     * Get history
     *
     * @return \Main\MainBundle\Entity\UserHistory 
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * Add sponsor
     *
     * @param \Main\MainBundle\Entity\User $sponsor
     * @return User
     */
    public function addSponsor(User $sponsor)
    {
        $this->sponsor[] = $sponsor;

        return $this;
    }

    /**
     * Remove sponsor
     *
     * @param \Main\MainBundle\Entity\User $sponsor
     */
    public function removeSponsor(User $sponsor)
    {
        $this->sponsor->removeElement($sponsor);
    }

    /**
     * Add history
     *
     * @param \Main\MainBundle\Entity\UserHistory $history
     * @return User
     */
    public function addHistory(UserHistory $history)
    {
        $this->history[] = $history;

        return $this;
    }

    /**
     * Remove history
     *
     * @param \Main\MainBundle\Entity\UserHistory $history
     */
    public function removeHistory(UserHistory $history)
    {
        $this->history->removeElement($history);
    }

    /**
     * @param User $user
     * @param int $ammount
     * @param EntityManager $em
     * @param Notifier $notifier
     */
    public function childAccountActivate(User $user, $ammount, EntityManager $em, Notifier $notifier) {
        $this->statistics->setPeopleCount($this->statistics->getPeopleCount() + 1);
        $message = "На ваш счет зачислено " . $ammount . "$ от " .
            $user->getUsername() . ", который присоединился к вашей команде!";
        $notifier->createNotification($this->id, $message);

        $message = 'Получено ' . $ammount . '$ за активацию аккаунта от пользователя ' .
            $user->getUsername();

        UserHistory::addToHistory($em, $this->getId(), $ammount, $message);
        $this->wallet->setBalance($this->wallet->getBalance() + $ammount);
        $this->statistics->setEarnedMoney($this->statistics->getEarnedMoney() + $ammount);
        if ($this->sponsor == null) {
            $this->setSponsorid($user->getId());
        }
    }

    /**
     * Add notifications
     *
     * @param \Main\MainBundle\Entity\Notification $notifications
     * @return User
     */
    public function addNotification(\Main\MainBundle\Entity\Notification $notifications)
    {
        $this->notifications[] = $notifications;

        return $this;
    }

    /**
     * Remove notifications
     *
     * @param \Main\MainBundle\Entity\Notification $notifications
     */
    public function removeNotification(\Main\MainBundle\Entity\Notification $notifications)
    {
        $this->notifications->removeElement($notifications);
    }

    /**
     * Get notifications
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * @return int
     */
    public function getNewNotificationsCount() {
        $newNotifications = 0;

        /** @var Notification $notify */
        foreach($this->notifications as $notify) {
            if ($notify->getActive() == false) {
                $newNotifications++;
            }
        }
        return $newNotifications;
    }
}
