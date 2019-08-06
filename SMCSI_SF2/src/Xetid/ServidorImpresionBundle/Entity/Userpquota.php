<?php

namespace Xetid\ServidorImpresionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Userpquota
 *
 * @ORM\Table(name="userpquota", uniqueConstraints={@ORM\UniqueConstraint(name="userpquota_up_id_ix", columns={"userid", "printerid"})}, indexes={@ORM\Index(name="userpquota_p_id_ix", columns={"printerid"}), @ORM\Index(name="userpquota_u_id_ix", columns={"userid"}), @ORM\Index(name="IDX_782443567D30AE2518809D86", columns={"printerid", "printersserverid"}), @ORM\Index(name="IDX_78244356F132696E8F2EC8EA", columns={"userid", "usersserverid"})})
 * @ORM\Entity
 */
class Userpquota
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
     * @var integer
     *
     * @ORM\Column(name="lifepagecounter", type="integer", nullable=true)
     */
    private $lifepagecounter = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="pagecounter", type="integer", nullable=true)
     */
    private $pagecounter = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="softlimit", type="integer", nullable=true)
     */
    private $softlimit;

    /**
     * @var integer
     *
     * @ORM\Column(name="hardlimit", type="integer", nullable=true)
     */
    private $hardlimit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datelimit", type="datetime", nullable=true)
     */
    private $datelimit;

    /**
     * @var integer
     *
     * @ORM\Column(name="maxjobsize", type="integer", nullable=true)
     */
    private $maxjobsize;

    /**
     * @var integer
     *
     * @ORM\Column(name="warncount", type="integer", nullable=true)
     */
    private $warncount = '0';

    /**
     * @var \Printers
     *
     * @ORM\ManyToOne(targetEntity="Printers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="printerid", referencedColumnName="id"),
     *   @ORM\JoinColumn(name="printersserverid", referencedColumnName="serverid")
     * })
     */
    private $printerid;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userid", referencedColumnName="id"),
     *   @ORM\JoinColumn(name="usersserverid", referencedColumnName="serverid")
     * })
     */
    private $userid;



    /**
     * Set id
     *
     * @param integer $id
     * @return Userpquota
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
     * Set lifepagecounter
     *
     * @param integer $lifepagecounter
     * @return Userpquota
     */
    public function setLifepagecounter($lifepagecounter)
    {
        $this->lifepagecounter = $lifepagecounter;

        return $this;
    }

    /**
     * Get lifepagecounter
     *
     * @return integer 
     */
    public function getLifepagecounter()
    {
        return $this->lifepagecounter;
    }

    /**
     * Set pagecounter
     *
     * @param integer $pagecounter
     * @return Userpquota
     */
    public function setPagecounter($pagecounter)
    {
        $this->pagecounter = $pagecounter;

        return $this;
    }

    /**
     * Get pagecounter
     *
     * @return integer 
     */
    public function getPagecounter()
    {
        return $this->pagecounter;
    }

    /**
     * Set softlimit
     *
     * @param integer $softlimit
     * @return Userpquota
     */
    public function setSoftlimit($softlimit)
    {
        $this->softlimit = $softlimit;

        return $this;
    }

    /**
     * Get softlimit
     *
     * @return integer 
     */
    public function getSoftlimit()
    {
        return $this->softlimit;
    }

    /**
     * Set hardlimit
     *
     * @param integer $hardlimit
     * @return Userpquota
     */
    public function setHardlimit($hardlimit)
    {
        $this->hardlimit = $hardlimit;

        return $this;
    }

    /**
     * Get hardlimit
     *
     * @return integer 
     */
    public function getHardlimit()
    {
        return $this->hardlimit;
    }

    /**
     * Set datelimit
     *
     * @param \DateTime $datelimit
     * @return Userpquota
     */
    public function setDatelimit($datelimit)
    {
        $this->datelimit = $datelimit;

        return $this;
    }

    /**
     * Get datelimit
     *
     * @return \DateTime 
     */
    public function getDatelimit()
    {
        return $this->datelimit;
    }

    /**
     * Set maxjobsize
     *
     * @param integer $maxjobsize
     * @return Userpquota
     */
    public function setMaxjobsize($maxjobsize)
    {
        $this->maxjobsize = $maxjobsize;

        return $this;
    }

    /**
     * Get maxjobsize
     *
     * @return integer 
     */
    public function getMaxjobsize()
    {
        return $this->maxjobsize;
    }

    /**
     * Set warncount
     *
     * @param integer $warncount
     * @return Userpquota
     */
    public function setWarncount($warncount)
    {
        $this->warncount = $warncount;

        return $this;
    }

    /**
     * Get warncount
     *
     * @return integer 
     */
    public function getWarncount()
    {
        return $this->warncount;
    }

    /**
     * Set printerid
     *
     * @param \Xetid\ServidorImpresionBundle\Entity\Printers $printerid
     * @return Userpquota
     */
    public function setPrinterid(\Xetid\ServidorImpresionBundle\Entity\Printers $printerid = null)
    {
        $this->printerid = $printerid;

        return $this;
    }

    /**
     * Get printerid
     *
     * @return \Xetid\ServidorImpresionBundle\Entity\Printers 
     */
    public function getPrinterid()
    {
        return $this->printerid;
    }

    /**
     * Set userid
     *
     * @param \Xetid\ServidorImpresionBundle\Entity\Users $userid
     * @return Userpquota
     */
    public function setUserid(\Xetid\ServidorImpresionBundle\Entity\Users $userid = null)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return \Xetid\ServidorImpresionBundle\Entity\Users 
     */
    public function getUserid()
    {
        return $this->userid;
    }
}
