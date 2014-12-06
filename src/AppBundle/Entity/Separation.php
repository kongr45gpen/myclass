<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Separation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Separation
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", length=255)
     */
    private $fullName;

    /**
     * @ORM\OneToMany(targetEntity="Orientation", mappedBy="separation")
     */
    private $orientations;

    /**
     * @var string
     *
     * @ORM\Column(name="colour", type="string", length=15, nullable=true)
     */
    private $colour;


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
     * Set name
     *
     * @param string $name
     * @return Separation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     * @return Separation
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orientations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add orientations
     *
     * @param \AppBundle\Entity\Orientation $orientations
     * @return Separation
     */
    public function addOrientation(\AppBundle\Entity\Orientation $orientations)
    {
        $this->orientations[] = $orientations;

        return $this;
    }

    /**
     * Remove orientations
     *
     * @param \AppBundle\Entity\Orientation $orientations
     */
    public function removeOrientation(\AppBundle\Entity\Orientation $orientations)
    {
        $this->orientations->removeElement($orientations);
    }

    /**
     * Get orientations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrientations()
    {
        return $this->orientations;
    }

    /**
     * Set colour
     *
     * @param string $colour
     * @return Separation
     */
    public function setColour($colour)
    {
        $this->colour = $colour;

        return $this;
    }

    /**
     * Get colour
     *
     * @return string
     */
    public function getColour()
    {
        return $this->colour;
    }

    /**
     * Convert to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
