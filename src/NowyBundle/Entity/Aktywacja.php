<?php

namespace NowyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Aktywacja
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Aktywacja
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     *
     * @var type \DateTime
     * 
     * @ORM\Column(name="od", type="datetime")
     */
    private $od;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="aktywacja", type="datetime",nullable=true)
     */
    private $aktywacja;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="do", type="datetime")
     */
    private $do;
    
    /**
     * 
     *@ORM\ManyToOne(targetEntity="Nrtelefonu", inversedBy="aktywacja")
     *
     */
    private $nrtelefon;
    
    /**
     * 
     *@ORM\ManyToOne(targetEntity="Package", inversedBy="aktywacja")
     *
     */
    private $package;
 
    
    
    public function __construct() {
        $this->od= new \DateTime();
        $this->aktywacja= new \DateTime();
        $this->do= new \DateTime();
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
     * Set od
     *
     * @param \DateTime $od
     *
     * @return Aktywacja
     */
    public function setOd($od)
    {
        $this->od = $od;

        return $this;
    }

    /**
     * Get od
     *
     * @return \DateTime
     */
    public function getOd()
    {
        return $this->od;
    }

    /**
     * Set aktywacja
     *
     * @param \DateTime $aktywacja
     *
     * @return Aktywacja
     */
    public function setAktywacja($aktywacja)
    {
        $this->aktywacja = $aktywacja;

        return $this;
    }

    /**
     * Get aktywacja
     *
     * @return \DateTime
     */
    public function getAktywacja()
    {
        return $this->aktywacja;
    }

    /**
     * Set do
     *
     * @param \DateTime $do
     *
     * @return Aktywacja
     */
    public function setDo($do)
    {
        $this->do = $do;

        return $this;
    }

    /**
     * Get do
     *
     * @return \DateTime
     */
    public function getDo()
    {
        return $this->do;
    }

    /**
     * Set nrtelefon
     *
     * @param \NowyBundle\Entity\Nrtelefonu $nrtelefon
     *
     * @return Aktywacja
     */
    public function setNrtelefon(\NowyBundle\Entity\Nrtelefonu $nrtelefon = null)
    {
        $this->nrtelefon = $nrtelefon;

        return $this;
    }

    /**
     * Get nrtelefon
     *
     * @return \NowyBundle\Entity\Nrtelefonu
     */
    public function getNrtelefon()
    {
        return $this->nrtelefon;
    }

    /**
     * Set package
     *
     * @param \NowyBundle\Entity\Package $package
     *
     * @return Aktywacja
     */
    public function setPackage(\NowyBundle\Entity\Package $package = null)
    {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return \NowyBundle\Entity\Package
     */
    public function getPackage()
    {
        return $this->package;
    }
}
