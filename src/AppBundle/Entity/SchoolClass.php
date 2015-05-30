<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * SchoolClass
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\SchoolClassRepository")
 */
class SchoolClass
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
     * @ORM\Column(name="name", type="string", length=10)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="default", type="boolean")
     */
    private $default;

    /**
     * @ORM\ManyToOne(targetEntity="Orientation", inversedBy="classes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orientation;

    /**
     * @Serializer\Accessor(getter="getActiveSchedule")
     * @Serializer\Type("array<AppBundle\Entity\ScheduleItem>")
     * @ORM\OneToMany(targetEntity="ScheduleItem", mappedBy="class")
     */
    private $schedule;


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
     * @return SchoolClass
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
     * Constructor
     */
    public function __construct()
    {
        $this->schedule = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set orientation
     *
     * @param \AppBundle\Entity\Orientation $orientation
     * @return SchoolClass
     */
    public function setOrientation(\AppBundle\Entity\Orientation $orientation = null)
    {
        $this->orientation = $orientation;

        return $this;
    }

    /**
     * Get orientation
     *
     * @return \AppBundle\Entity\Orientation
     */
    public function getOrientation()
    {
        return $this->orientation;
    }

    /**
     * Add schedule
     *
     * @param \AppBundle\Entity\ScheduleItem $schedule
     * @return SchoolClass
     */
    public function addSchedule(\AppBundle\Entity\ScheduleItem $schedule)
    {
        $this->schedule[] = $schedule;

        return $this;
    }

    /**
     * Remove schedule
     *
     * @param \AppBundle\Entity\ScheduleItem $schedule
     */
    public function removeSchedule(\AppBundle\Entity\ScheduleItem $schedule)
    {
        $this->schedule->removeElement($schedule);
    }

    /**
     * Get schedule
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSchedule()
    {
        return $this->schedule;
    }

    /**
     * Set default
     *
     * @param boolean $default
     * @return SchoolClass
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Get default
     *
     * @return boolean
     */
    public function isDefault()
    {
        return $this->default;
    }

    /**
     * Convert to string
     *
     * @Serializer\SerializedName("alias")
     * @Serializer\VirtualProperty
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Get the items of the schedule that are not disabled
     *
     * @return array
     */
    public function getActiveSchedule()
    {
        return $this->schedule->filter(function($item) {
            return ScheduleItem::STATUS_DISABLED !== $item->getStatus();
        })->getValues();
    }

    /**
     * Get default
     *
     * @return boolean
     */
    public function getDefault()
    {
        return $this->default;
    }
}
