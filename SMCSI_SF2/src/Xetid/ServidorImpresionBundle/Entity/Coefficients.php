<?php

namespace Xetid\ServidorImpresionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Coefficients
 *
 * @ORM\Table(name="coefficients", uniqueConstraints={@ORM\UniqueConstraint(name="coeffconstraint", columns={"printerid", "label"})}, indexes={@ORM\Index(name="IDX_218498DE7D30AE2518809D86", columns={"printerid", "printersserverid"})})
 * @ORM\Entity
 */
class Coefficients
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
     * @ORM\Column(name="label", type="text", nullable=false)
     */
    private $label;

    /**
     * @var float
     *
     * @ORM\Column(name="coefficient", type="float", precision=10, scale=0, nullable=true)
     */
    private $coefficient = '1.0';

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
     * @return Coefficients
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
     * Set label
     *
     * @param string $label
     * @return Coefficients
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set coefficient
     *
     * @param float $coefficient
     * @return Coefficients
     */
    public function setCoefficient($coefficient)
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    /**
     * Get coefficient
     *
     * @return float 
     */
    public function getCoefficient()
    {
        return $this->coefficient;
    }

    /**
     * Set printerid
     *
     * @param \Xetid\ServidorImpresionBundle\Entity\Printers $printerid
     * @return Coefficients
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
