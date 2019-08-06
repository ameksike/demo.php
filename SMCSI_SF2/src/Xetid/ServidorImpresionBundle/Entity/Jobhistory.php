<?php

namespace Xetid\ServidorImpresionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jobhistory
 *
 * @ORM\Table(name="jobhistory", indexes={@ORM\Index(name="jobhistory_hostname_ix", columns={"hostname"}), @ORM\Index(name="jobhistory_pd_id_ix", columns={"printerid", "jobdate"}), @ORM\Index(name="jobhistory_u_id_ix", columns={"userid"}), @ORM\Index(name="jobhistory_p_id_ix", columns={"printerid"}), @ORM\Index(name="IDX_8E8DBA49B665D5D", columns={"serverid"})})
 * @ORM\Entity(repositoryClass="Xetid\ServidorImpresionBundle\Entity\Model\JobhistoryRepository")
 */
class Jobhistory
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
     * @ORM\Column(name="jobid", type="text", nullable=true)
     */
    private $jobid;

    /**
     * @var integer
     *
     * @ORM\Column(name="userid", type="integer", nullable=false)
     */
    private $userid;

    /**
     * @var integer
     *
     * @ORM\Column(name="printerid", type="integer", nullable=true)
     */
    private $printerid;

    /**
     * @var integer
     *
     * @ORM\Column(name="pagecounter", type="integer", nullable=true)
     */
    private $pagecounter = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="jobsizebytes", type="bigint", nullable=true)
     */
    private $jobsizebytes;

    /**
     * @var integer
     *
     * @ORM\Column(name="jobsize", type="integer", nullable=true)
     */
    private $jobsize;

    /**
     * @var float
     *
     * @ORM\Column(name="jobprice", type="float", precision=10, scale=0, nullable=true)
     */
    private $jobprice;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="text", nullable=true)
     */
    private $action;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="text", nullable=true)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="copies", type="integer", nullable=true)
     */
    private $copies;

    /**
     * @var string
     *
     * @ORM\Column(name="options", type="text", nullable=true)
     */
    private $options;

    /**
     * @var string
     *
     * @ORM\Column(name="hostname", type="text", nullable=true)
     */
    private $hostname;

    /**
     * @var string
     *
     * @ORM\Column(name="md5sum", type="text", nullable=true)
     */
    private $md5sum;

    /**
     * @var string
     *
     * @ORM\Column(name="pages", type="text", nullable=true)
     */
    private $pages;

    /**
     * @var string
     *
     * @ORM\Column(name="billingcode", type="text", nullable=true)
     */
    private $billingcode;

    /**
     * @var integer
     *
     * @ORM\Column(name="precomputedjobsize", type="integer", nullable=true)
     */
    private $precomputedjobsize;

    /**
     * @var float
     *
     * @ORM\Column(name="precomputedjobprice", type="float", precision=10, scale=0, nullable=true)
     */
    private $precomputedjobprice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="jobdate", type="datetime", nullable=true)
     */
    private $jobdate = 'now()';

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
     * @return Jobhistory
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
     * Set jobid
     *
     * @param string $jobid
     * @return Jobhistory
     */
    public function setJobid($jobid)
    {
        $this->jobid = $jobid;

        return $this;
    }

    /**
     * Get jobid
     *
     * @return string 
     */
    public function getJobid()
    {
        return $this->jobid;
    }

    /**
     * Set userid
     *
     * @param integer $userid
     * @return Jobhistory
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return integer 
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set printerid
     *
     * @param integer $printerid
     * @return Jobhistory
     */
    public function setPrinterid($printerid)
    {
        $this->printerid = $printerid;

        return $this;
    }

    /**
     * Get printerid
     *
     * @return integer 
     */
    public function getPrinterid()
    {
        return $this->printerid;
    }

    /**
     * Set pagecounter
     *
     * @param integer $pagecounter
     * @return Jobhistory
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
     * Set jobsizebytes
     *
     * @param integer $jobsizebytes
     * @return Jobhistory
     */
    public function setJobsizebytes($jobsizebytes)
    {
        $this->jobsizebytes = $jobsizebytes;

        return $this;
    }

    /**
     * Get jobsizebytes
     *
     * @return integer 
     */
    public function getJobsizebytes()
    {
        return $this->jobsizebytes;
    }

    /**
     * Set jobsize
     *
     * @param integer $jobsize
     * @return Jobhistory
     */
    public function setJobsize($jobsize)
    {
        $this->jobsize = $jobsize;

        return $this;
    }

    /**
     * Get jobsize
     *
     * @return integer 
     */
    public function getJobsize()
    {
        return $this->jobsize;
    }

    /**
     * Set jobprice
     *
     * @param float $jobprice
     * @return Jobhistory
     */
    public function setJobprice($jobprice)
    {
        $this->jobprice = $jobprice;

        return $this;
    }

    /**
     * Get jobprice
     *
     * @return float 
     */
    public function getJobprice()
    {
        return $this->jobprice;
    }

    /**
     * Set action
     *
     * @param string $action
     * @return Jobhistory
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

    /**
     * Set filename
     *
     * @param string $filename
     * @return Jobhistory
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Jobhistory
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set copies
     *
     * @param integer $copies
     * @return Jobhistory
     */
    public function setCopies($copies)
    {
        $this->copies = $copies;

        return $this;
    }

    /**
     * Get copies
     *
     * @return integer 
     */
    public function getCopies()
    {
        return $this->copies;
    }

    /**
     * Set options
     *
     * @param string $options
     * @return Jobhistory
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get options
     *
     * @return string 
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set hostname
     *
     * @param string $hostname
     * @return Jobhistory
     */
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;

        return $this;
    }

    /**
     * Get hostname
     *
     * @return string 
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * Set md5sum
     *
     * @param string $md5sum
     * @return Jobhistory
     */
    public function setMd5sum($md5sum)
    {
        $this->md5sum = $md5sum;

        return $this;
    }

    /**
     * Get md5sum
     *
     * @return string 
     */
    public function getMd5sum()
    {
        return $this->md5sum;
    }

    /**
     * Set pages
     *
     * @param string $pages
     * @return Jobhistory
     */
    public function setPages($pages)
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * Get pages
     *
     * @return string 
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Set billingcode
     *
     * @param string $billingcode
     * @return Jobhistory
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
     * Set precomputedjobsize
     *
     * @param integer $precomputedjobsize
     * @return Jobhistory
     */
    public function setPrecomputedjobsize($precomputedjobsize)
    {
        $this->precomputedjobsize = $precomputedjobsize;

        return $this;
    }

    /**
     * Get precomputedjobsize
     *
     * @return integer 
     */
    public function getPrecomputedjobsize()
    {
        return $this->precomputedjobsize;
    }

    /**
     * Set precomputedjobprice
     *
     * @param float $precomputedjobprice
     * @return Jobhistory
     */
    public function setPrecomputedjobprice($precomputedjobprice)
    {
        $this->precomputedjobprice = $precomputedjobprice;

        return $this;
    }

    /**
     * Get precomputedjobprice
     *
     * @return float 
     */
    public function getPrecomputedjobprice()
    {
        return $this->precomputedjobprice;
    }

    /**
     * Set jobdate
     *
     * @param \DateTime $jobdate
     * @return Jobhistory
     */
    public function setJobdate($jobdate)
    {
        $this->jobdate = $jobdate;

        return $this;
    }

    /**
     * Get jobdate
     *
     * @return \DateTime 
     */
    public function getJobdate()
    {
        return $this->jobdate;
    }

    /**
     * Set serverid
     *
     * @param \Xetid\ServidorImpresionBundle\Entity\Server $serverid
     * @return Jobhistory
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
