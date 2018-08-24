<?php

namespace OC\WestoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Members
 *
 * @ORM\Table(name="ocp5_members")
 * @ORM\Entity(repositoryClass="OC\WestoryBundle\Repository\MembersRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Members implements UserInterface
{
    /**
     * @ORM\OneToOne(targetEntity="OC\WestoryBundle\Entity\Avatar", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $avatar;

    /**
     * @var int
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
     * @Assert\Length(
     *      min=3, 
     *      minMessage="Le pseudo choisit doit faire au minimum {{ limit }} caractères."
     * )
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Assert\Length(
     *      min=7,
     *      max=20, 
     *      minMessage="Le mot de passe doit faire au minimum {{ limit }} caractères.", 
     *      maxMessage="Le mot de passe doit faire au maximum {{ limit }} caractères."
     * )
     */
    private $password;

    private $oldPassword;

    /**
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="emailAddress", type="string", length=255, unique=true)
     * @Assert\Email(
     *      message = "L'adresse Email '{{ value }}' n'est pas une adresse valide.",
     *      checkMX = true
     * )
     */
    private $emailAddress;

    /**
     * @var int
     *
     * @ORM\Column(name="votesReceived", type="integer")
     */
    private $votesReceived;

    /**
     * @var int
     *
     * @ORM\Column(name="votesNumber", type="integer")
     */
    private $votesNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registerDate", type="datetime")
     * @Assert\DateTime()
     */
    private $registerDate;

    /**
     * @ORM\Column(name="roles", type="array")
     */
    private $roles = array();

    

    public function __construct(){
        $this->registerDate = new \Datetime();
        $this->votesReceived = 0;
        $this->votesNumber = 3;
        $this->roles = array('ROLE_USER');
        $this->salt = '';
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Members
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
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
     * Set password
     *
     * @param string $password
     *
     * @return Members
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function setOldPassword($oldPassword)
    {
        $this->oldPassword = $oldPassword;

        return $this;
    }

    public function getOldPassword()
    {
        return $this->oldPassword;
    }

    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     *
     * @return Members
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * Get emailAddress
     *
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * Set votesReceived
     *
     * @param integer $votesReceived
     *
     * @return Members
     */
    public function setVotesReceived($votesReceived)
    {
        $this->votesReceived = $votesReceived;

        return $this;
    }

    /**
     * Get votesReceived
     *
     * @return int
     */
    public function getVotesReceived()
    {
        return $this->votesReceived;
    }

    public function incrementVotesReceived(){
        $this->votesReceived = $this->votesReceived + 1;
        return $this;
    }

    /**
     * Set votesNumber
     *
     * @param integer $votesNumber
     *
     * @return Members
     */
    public function setVotesNumber($votesNumber)
    {
        $this->votesNumber = $votesNumber;

        return $this;
    }

    /**
     * Get votesNumber
     *
     * @return int
     */
    public function getVotesNumber()
    {
        return $this->votesNumber;
    }

    public function decrementVotesNumber(){
        $this->votesNumber = $this->votesNumber -1;
        return $this;
    }

    /**
     * Set registerDate
     *
     * @param \DateTime $registerDate
     *
     * @return Members
     */
    public function setRegisterDate($registerDate)
    {
        $this->registerDate = $registerDate;

        return $this;
    }

    /**
     * Get registerDate
     *
     * @return \DateTime
     */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    public function setAvatar(Avatar $avatar = null){
        $this->avatar = $avatar;
    }

    public function getAvatar(){
        return $this->avatar;
    }

    public function eraseCredentials(){
    }



    public function getRoles(){
        return $this->roles;
    }

    public function getSalt(){
        return $this->salt;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return Members
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return Members
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }


}
