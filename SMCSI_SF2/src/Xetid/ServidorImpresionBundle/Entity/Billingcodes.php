<?php

namespace Xetid\ServidorImpresionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Billingcodes
 *
 * @ORM\Table(name="billingcodes", uniqueConstraints={@ORM\UniqueConstraint(name="billingcodes_billingcode_key", columns={"billingcode"})}, indexes={@ORM\Index(name="IDX_C7FA8F91B665D5D", columns={"serverid"})})
 * @ORM\Entity
 */
class Billingcodes
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
     * @ORM\Column(name="billingcode", type="text", nullable=false)
     */
    private $billingcode;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="balance", type="float", precision=10, scale=0, nullable=true)
     */
    private $balance = '0.0';

    /**
     * @var integer
     *
     * @ORM\Column(name="pagecounter", type="integer", nullable=true)
     */
    private $pagecounter = '0';

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
     * Set id
     *
     * @param integer $id
     * @return Billingcodes
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
     * Set billingcode
     *
     * @param string $billingcode
     * @return Billingcodes
     */
    public function setBillingcode($billingcode)
    {
        $this->billingcode = $billingcode;

        return $this;
    }

    /**
     * Get billingcode
     *
     * @return string 
     */
    public function getBillingcode()
    {
        return $this->billingcode;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Billingcodes
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
     * Set balance
     *
     * @param float $balance
     * @return Billingcodes
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
     * Set pagecounter
     *
     * @param integer $pagecounter
     * @return Billingcodes
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
     * Set serverid
     *
     * @param \Xetid\ServidorImpresionBundle\Entity\Server $serverid
     * @return Billingcodes
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
}
