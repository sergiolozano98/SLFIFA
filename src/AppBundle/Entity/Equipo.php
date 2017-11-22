<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipo
 *
 * @ORM\Table(name="equipo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EquipoRepository")
 */
class Equipo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @ORM\OneToMany(targetEntity="top100", mappedBy="equipo")
    */
    private $top;


    /**
     * @var string
     *
     * @ORM\Column(name="equipo", type="string", length=255)
     */
    private $equipo;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set equipo
     *
     * @param string $equipo
     *
     * @return Equipo
     */
    public function setEquipo($equipo)
    {
        $this->equipo = $equipo;

        return $this;
    }

    /**
     * Get equipo
     *
     * @return string
     */
    public function getEquipo()
    {
        return $this->equipo;
    }

    public function __toString()
    {
        return $this->equipo;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->top = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add top
     *
     * @param \AppBundle\Entity\top100 $top
     *
     * @return Equipo
     */
    public function addTop(\AppBundle\Entity\top100 $top)
    {
        $this->top[] = $top;

        return $this;
    }

    /**
     * Remove top
     *
     * @param \AppBundle\Entity\top100 $top
     */
    public function removeTop(\AppBundle\Entity\top100 $top)
    {
        $this->top->removeElement($top);
    }

    /**
     * Get top
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTop()
    {
        return $this->top;
    }
}
