<?php

namespace Helit\Bundle\MyClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Orientation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Orientation
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
     * @var string
     *
     * @ORM\Column(name="colour", type="string", length=15, nullable=true)
     */
    private $colour;

    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=30, nullable=true)
     */
    private $icon;

    /**
     * @ORM\ManyToOne(targetEntity="Separation", inversedBy="orientations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $separation;

    /**
     * @ORM\OneToMany(targetEntity="SchoolClass", mappedBy="orientation")
     */
    private $classes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->classes = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Orientation
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
     * @return Orientation
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
     * Set separation
     *
     * @param \Helit\Bundle\MyClassBundle\Entity\Separation $separation
     * @return Orientation
     */
    public function setSeparation(\Helit\Bundle\MyClassBundle\Entity\Separation $separation = null)
    {
        $this->separation = $separation;

        return $this;
    }

    /**
     * Get separation
     *
     * @return \Helit\Bundle\MyClassBundle\Entity\Separation
     */
    public function getSeparation()
    {
        return $this->separation;
    }

    /**
     * Add classes
     *
     * @param \Helit\Bundle\MyClassBundle\Entity\SchoolClass $classes
     * @return Orientation
     */
    public function addClass(\Helit\Bundle\MyClassBundle\Entity\SchoolClass $classes)
    {
        $this->classes[] = $classes;

        return $this;
    }

    /**
     * Remove classes
     *
     * @param \Helit\Bundle\MyClassBundle\Entity\SchoolClass $classes
     */
    public function removeClass(\Helit\Bundle\MyClassBundle\Entity\SchoolClass $classes)
    {
        $this->classes->removeElement($classes);
    }

    /**
     * Get classes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * Set colour
     *
     * @param string $colour
     * @return Orientation
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
     * Set icon
     *
     * @param string $icon
     * @return Orientation
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
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
