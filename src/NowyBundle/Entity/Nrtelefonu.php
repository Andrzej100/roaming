<?php

namespace NowyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * nrtelefonu
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Nrtelefonu
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
     * @var integer
     *
     * @ORM\Column(name="numer", type="integer")
     */
    private $numer;
    
   /**
     * 
     *@ORM\ManyToOne(targetEntity="Uzytkownik", inversedBy="nrtelefonu")
     *
     */
    private $uzytkownik;

   
    public function __toString() {
        return (string)$this->numer;
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
     * Set numer
     *
     * @param integer $numer
     *
     * @return Nrtelefonu
     */
    public function setNumer($numer)
    {
        $this->numer = $numer;

        return $this;
    }

    /**
     * Get numer
     *
     * @return integer
     */
    public function getNumer()
    {
        return $this->numer;
    }

    /**
     * Set uzytkownik
     *
     * @param \NowyBundle\Entity\Uzytkownik $uzytkownik
     *
     * @return Nrtelefonu
     */
    public function setUzytkownik(\NowyBundle\Entity\Uzytkownik $uzytkownik = null)
    {
        $this->uzytkownik = $uzytkownik;

        return $this;
    }

    /**
     * Get uzytkownik
     *
     * @return \NowyBundle\Entity\Uzytkownik
     */
    public function getUzytkownik()
    {
        return $this->uzytkownik;
    }
}
