<?php

namespace Xetid\ServidorImpresionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;
/**
 * Users
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="users_username_key", columns={"username"})}, indexes={@ORM\Index(name="IDX_1483A5E9B665D5D", columns={"serverid"})})
 * @ORM\Entity(repositoryClass="Xetid\ServidorImpresionBundle\Entity\Model\UsersRepository")
 */
class Users
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="text", nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="text", nullable=true)
     */
    private $email;

    /**
     * @var float
     *
     * @ORM\Column(name="balance", type="float", precision=10, scale=0, nullable=true)
     */
    private $balance = '0.0';

    /**
     * @var float
     *
     * @ORM\Column(name="lifetimepaid", type="float", precision=10, scale=0, nullable=true)
     */
    private $lifetimepaid = '0.0';

    /**
     * @var string
     *
     * @ORM\Column(name="limitby", type="text", nullable=true)
     */
    private $limitby = 'quota';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="overcharge", type="float", precision=10, scale=0, nullable=false)
     */
    private $overcharge = '1.0';

    /**
     * @var \Server
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Server")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="serverid", referencedColumnName="id")
     * })
     */
    private $serverid;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Groups", mappedBy="userid")
     */
    private $groupid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groupid = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set id
     *
     * @param integer $id
     * @return Users
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * @return Users
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
     * Set email
     *
     * @param string $email
     * @return Users
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
     * Set balance
     *
     * @param float $balance
     * @return Users
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return float 
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set lifetimepaid
     *
     * @param float $lifetimepaid
     * @return Users
     */
    public function setLifetimepaid($lifetimepaid)
    {
        $this->lifetimepaid = $lifetimepaid;

        return $this;
    }

    /**
     * Get lifetimepaid
     *
     * @return float 
     */
    public function getLifetimepaid()
    {
        return $this->lifetimepaid;
    }

    /**
     * Set limitby
     *
     * @param string $limitby
     * @return Users
     */
    public function setLimitby($limitby)
    {
        $this->limitby = $limitby;

        return $this;
    }

    /**
     * Get limitby
     *
     * @return string 
     */
    public function getLimitby()
    {
        return $this->limitby;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Users
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set overcharge
     *
     * @param float $overcharge
     * @return Users
     */
    public function setOvercharge($overcharge)
    {
        $this->overcharge = $overcharge;

        return $this;
    }

    /**
     * Get overcharge
     *
     * @return float 
     */
    public function getOvercharge()
    {
        return $this->overcharge;
    }

    /**
     * Set serverid
     *
     * @param \Xetid\ServidorImpresionBundle\Entity\Server $serverid
     * @return Users
     */
    public function setServerid(\Xetid\ServidorImpresionBundle\Entity\Server $serverid)
    {
        $this->serverid = $serverid;

        return $this;
    }

    /**
     * Get serverid
     *
     * @return \Xetid\ServidorImpresionBundle\Entity\Server 
     */
    public function getServerid()
    {
        return $this->serverid;
    }

    /**
     * Add groupid
     *
     * @param \Xetid\ServidorImpresionBundle\Entity\Groups $groupid
     * @return Users
     */
    public function addGroupid(\Xetid\ServidorImpresionBundle\Entity\Groups $groupid)
    {
        $this->groupid[] = $groupid;

        return $this;
    }

    /**
     * Remove groupid
     *
     * @param \Xetid\ServidorImpresionBundle\Entity\Groups $groupid
     */
    public function removeGroupid(\Xetid\ServidorImpresionBundle\Entity\Groups $groupid)
    {
        $this->groupid->removeElement($groupid);
    }

    /**
     * Get groupid
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroupid()
    {
        return $this->groupid;
    }
}
