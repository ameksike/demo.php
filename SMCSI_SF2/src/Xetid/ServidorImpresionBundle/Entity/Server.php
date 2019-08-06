<?php

namespace Xetid\ServidorImpresionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Server
 *
 * @ORM\Table(name="server")
 * @ORM\Entity(repositoryClass="Xetid\ServidorImpresionBundle\Entity\Model\ServerRepository")
 */
class Server
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="server_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="denomination", type="string", length=255, nullable=true)
     */
    private $denomination;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="text", nullable=true)
     */
    private $place;

    /**
     * @var string
     *
     * @ORM\Column(name="supporter", type="string", length=255, nullable=true)
     */
    private $supporter;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;



    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set denomination
     *
     * @param string $denomination
     * @return Server
     */
    public function setDenomination($denomination)
    {
        $this->denomination = $denomination;

        return $this;
    }

    /**
     * Get denomination
     *
     * @return string 
     */
    public function getDenomination()
    {
        return $this->denomination;
    }

    /**
     * Set place
     *
     * @param string $place
     * @return Server
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string 
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set supporter
     *
     * @param string $supporter
     * @return Server
     */
    public function setSupporter($supporter)
    {
        $this->supporter = $supporter;

        return $this;
    }

    /**
     * Get supporter
     *
     * @return string 
     */
    public function getSupporter()
    {
        return $this->supporter;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Server
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
     * Set description
     *
     * @param string $description
     * @return Server
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
}
