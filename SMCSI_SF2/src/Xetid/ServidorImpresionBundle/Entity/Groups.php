<?php

namespace Xetid\ServidorImpresionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groups
 *
 * @ORM\Table(name="groups", uniqueConstraints={@ORM\UniqueConstraint(name="groups_groupname_key", columns={"groupname"})}, indexes={@ORM\Index(name="IDX_F06D3970B665D5D", columns={"serverid"})})
 * @ORM\Entity(repositoryClass="Xetid\ServidorImpresionBundle\Entity\Model\GroupsRepository")
 */
class Groups
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
     * @ORM\Column(name="groupname", type="text", nullable=false)
     */
    private $groupname;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="limitby", type="text", nullable=true)
     */
    private $limitby = 'quota';

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
     * @ORM\ManyToMany(targetEntity="Users", inversedBy="groupid")
     * @ORM\JoinTable(name="groupsmembers",
     *   joinColumns={
     *     @ORM\JoinColumn(name="groupid", referencedColumnName="id"),
     *     @ORM\JoinColumn(name="groupsserverid", referencedColumnName="serverid")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="userid", referencedColumnName="id"),
     *     @ORM\JoinColumn(name="usersserverid", referencedColumnName="serverid")
     *   }
     * )
     */
    private $userid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userid = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set id
     *
     * @param integer $id
     * @return Groups
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
     * Set groupname
     *
     * @param string $groupname
     * @return Groups
     */
    public function setGroupname($groupname)
    {
        $this->groupname = $groupname;

        return $this;
    }

    /**
     * Get groupname
     *
     * @return string 
     */
    public function getGroupname()
    {
        return $this->groupname;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Groups
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
     * Set limitby
     *
     * @param string $limitby
     * @return Groups
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
     * Set serverid
     *
     * @param \Xetid\ServidorImpresionBundle\Entity\Server $serverid
     * @return Groups
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
     * Add userid
     *
     * @param \Xetid\ServidorImpresionBundle\Entity\Users $userid
     * @return Groups
     */
    public function addUserid(\Xetid\ServidorImpresionBundle\Entity\Users $userid)
    {
        $this->userid[] = $userid;

        return $this;
    }

    /**
     * Remove userid
     *
     * @param \Xetid\ServidorImpresionBundle\Entity\Users $userid
     */
    public function removeUserid(\Xetid\ServidorImpresionBundle\Entity\Users $userid)
    {
        $this->userid->removeElement($userid);
    }

    /**
     * Get userid
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserid()
    {
        return $this->userid;
    }
}
