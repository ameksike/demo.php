<?php

namespace Xetid\ServidorImpresionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Printers
 *
 * @ORM\Table(name="printers", uniqueConstraints={@ORM\UniqueConstraint(name="printers_printername_key", columns={"printername"})}, indexes={@ORM\Index(name="IDX_C5381DB7B665D5D", columns={"serverid"})})
 * @ORM\Entity(repositoryClass="Xetid\ServidorImpresionBundle\Entity\Model\PrintersRepository")
 */
class Printers
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
     * @ORM\Column(name="printername", type="text", nullable=false)
     */
    private $printername;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="priceperpage", type="float", precision=10, scale=0, nullable=true)
     */
    private $priceperpage = '0.0';

    /**
     * @var float
     *
     * @ORM\Column(name="priceperjob", type="float", precision=10, scale=0, nullable=true)
     */
    private $priceperjob = '0.0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="passthrough", type="boolean", nullable=true)
     */
    private $passthrough = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="maxjobsize", type="integer", nullable=true)
     */
    private $maxjobsize;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isgroups", type="boolean", nullable=true)
     */
    private $isgroups = false;

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
     * @ORM\ManyToMany(targetEntity="Printers", inversedBy="groupid")
     * @ORM\JoinTable(name="printergroupsmembers",
     *   joinColumns={
     *     @ORM\JoinColumn(name="groupid", referencedColumnName="id"),
     *     @ORM\JoinColumn(name="printersserverid", referencedColumnName="serverid")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="printerid", referencedColumnName="id"),
     *     @ORM\JoinColumn(name="printersserverid2", referencedColumnName="serverid")
     *   }
     * )
     */
    private $printerid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->printerid = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set id
     *
     * @param integer $id
     * @return Printers
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
     * Set printername
     *
     * @param string $printername
     * @return Printers
     */
    public function setPrintername($printername)
    {
        $this->printername = $printername;

        return $this;
    }

    /**
     * Get printername
     *
     * @return string 
     */
    public function getPrintername()
    {
        return $this->printername;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Printers
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
     * Set priceperpage
     *
     * @param float $priceperpage
     * @return Printers
     */
    public function setPriceperpage($priceperpage)
    {
        $this->priceperpage = $priceperpage;

        return $this;
    }

    /**
     * Get priceperpage
     *
     * @return float 
     */
    public function getPriceperpage()
    {
        return $this->priceperpage;
    }

    /**
     * Set priceperjob
     *
     * @param float $priceperjob
     * @return Printers
     */
    public function setPriceperjob($priceperjob)
    {
        $this->priceperjob = $priceperjob;

        return $this;
    }

    /**
     * Get priceperjob
     *
     * @return float 
     */
    public function getPriceperjob()
    {
        return $this->priceperjob;
    }

    /**
     * Set passthrough
     *
     * @param boolean $passthrough
     * @return Printers
     */
    public function setPassthrough($passthrough)
    {
        $this->passthrough = $passthrough;

        return $this;
    }

    /**
     * Get passthrough
     *
     * @return boolean 
     */
    public function getPassthrough()
    {
        return $this->passthrough;
    }

    /**
     * Set maxjobsize
     *
     * @param integer $maxjobsize
     * @return Printers
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
     * Set isgroups
     *
     * @param boolean $isgroups
     * @return Printers
     */
    public function setIsgroups($isgroups)
    {
        $this->isgroups = $isgroups;

        return $this;
    }

    /**
     * Get isgroups
     *
     * @return boolean 
     */
    public function getIsgroups()
    {
        return $this->isgroups;
    }

    /**
     * Set serverid
     *
     * @param \Xetid\ServidorImpresionBundle\Entity\Server $serverid
     * @return Printers
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
     * Add printerid
     *
     * @param \Xetid\ServidorImpresionBundle\Entity\Printers $printerid
     * @return Printers
     */
    public function addPrinterid(\Xetid\ServidorImpresionBundle\Entity\Printers $printerid)
    {
        $this->printerid[] = $printerid;

        return $this;
    }

    /**
     * Remove printerid
     *
     * @param \Xetid\ServidorImpresionBundle\Entity\Printers $printerid
     */
    public function removePrinterid(\Xetid\ServidorImpresionBundle\Entity\Printers $printerid)
    {
        $this->printerid->removeElement($printerid);
    }

    /**
     * Get printerid
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrinterid()
    {
        return $this->printerid;
    }
}
