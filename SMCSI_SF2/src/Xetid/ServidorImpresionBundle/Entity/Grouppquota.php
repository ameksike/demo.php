<?php

namespace Xetid\ServidorImpresionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Grouppquota
 *
 * @ORM\Table(name="grouppquota", uniqueConstraints={@ORM\UniqueConstraint(name="grouppquota_up_id_ix", columns={"groupid", "printerid"})}, indexes={@ORM\Index(name="grouppquota_g_id_ix", columns={"groupid"}), @ORM\Index(name="grouppquota_p_id_ix", columns={"printerid"}), @ORM\Index(name="IDX_CACA93697805AC1266936095", columns={"groupid", "groupsserverid"}), @ORM\Index(name="IDX_CACA93697D30AE2518809D86", columns={"printerid", "printersserverid"})})
 * @ORM\Entity(repositoryClass="Xetid\ServidorImpresionBundle\Entity\Model\GroupquotaRepository")
 */
class Grouppquota
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
     * @var integer
     *
     * @ORM\Column(name="maxjobsize", type="integer", nullable=true)
     */
    private $maxjobsize;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datelimit", type="datetime", nullable=true)
     */
    private $datelimit;

    /**
     * @var \Groups
     *
     * @ORM\ManyToOne(targetEntity="Groups")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="groupid", referencedColumnName="id"),
     *   @ORM\JoinColumn(name="groupsserverid", referencedColumnName="serverid")
     * })
     */
    private $groupid;

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
     * Set id
     *
     * @param integer $id
     * @return Grouppquota
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
     * Set softlimit
     *
     * @param integer $softlimit
     * @return Grouppquota
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
     * @return Grouppquota
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
     * Set maxjobsize
     *
     * @param integer $maxjobsize
     * @return Grouppquota
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
     * Set datelimit
     *
     * @param \DateTime $datelimit
     * @return Grouppquota
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
     * Set groupid
     *
     * @param \Xetid\ServidorImpresionBundle\Entity\Groups $groupid
     * @return Grouppquota
     */
    public function setGroupid(\Xetid\ServidorImpresionBundle\Entity\Groups $groupid = null)
    {
        $this->groupid = $groupid;

        return $this;
    }

    /**
     * Get groupid
     *
     * @return \Xetid\ServidorImpresionBundle\Entity\Groups 
     */
    public function getGroupid()
    {
        return $this->groupid;
    }

    /**
     * Set printerid
     *
     * @param \Xetid\ServidorImpresionBundle\Entity\Printers $printerid
     * @return Grouppquota
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
}
