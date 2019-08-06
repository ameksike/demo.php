<?php

namespace Xetid\AlertBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alert
 *
 * @ORM\Table(name="alert")
 * @ORM\Entity(repositoryClass="Xetid\AlertBundle\Entity\AlertRepository")
 */
class Alert
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="alert_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="den", type="string", nullable=true)
     */
    private $den;

    /**
     * @var string
     *
     * @ORM\Column(name="criteria", type="string", nullable=true)
     */
    private $criteria;

    /**
     * @var string
     *
     * @ORM\Column(name="objetive", type="string", nullable=true)
     */
    private $objetive;

    /**
     * @var string
     *
     * @ORM\Column(name="printer", type="string", nullable=true)
     */
    private $printer;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", nullable=true)
     */
    private $action;



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
     * Set den
     *
     * @param string $den
     * @return Alert
     */
    public function setDen($den)
    {
        $this->den = $den;

        return $this;
    }

    /**
     * Get den
     *
     * @return string 
     */
    public function getDen()
    {
        return $this->den;
    }

    /**
     * Set criteria
     *
     * @param string $criteria
     * @return Alert
     */
    public function setCriteria($criteria)
    {
        $this->criteria = $criteria;

        return $this;
    }

    /**
     * Get criteria
     *
     * @return string 
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * Set objetive
     *
     * @param string $objetive
     * @return Alert
     */
    public function setObjetive($objetive)
    {
        $this->objetive = $objetive;

        return $this;
    }

    /**
     * Get objetive
     *
     * @return string 
     */
    public function getObjetive()
    {
        return $this->objetive;
    }

    /**
     * Set printer
     *
     * @param string $printer
     * @return Alert
     */
    public function setPrinter($printer)
    {
        $this->printer = $printer;

        return $this;
    }

    /**
     * Get printer
     *
     * @return string 
     */
    public function getPrinter()
    {
        return $this->printer;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Alert
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set action
     *
     * @param string $action
     * @return Alert
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }
}
