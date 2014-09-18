<?php

namespace Helit\Bundle\MyClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SchoolClass
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Helit\Bundle\MyClassBundle\Entity\SchoolClassRepository")
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
     * @ORM\ManyToOne(targetEntity="Orientation", inversedBy="classes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orientation;

    /**
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
     * @param \Helit\Bundle\MyClassBundle\Entity\Orientation $orientation
     * @return SchoolClass
     */
    public function setOrientation(\Helit\Bundle\MyClassBundle\Entity\Orientation $orientation = null)
    {
        $this->orientation = $orientation;

        return $this;
    }

    /**
     * Get orientation
     *
     * @return \Helit\Bundle\MyClassBundle\Entity\Orientation
     */
    public function getOrientation()
    {
        return $this->orientation;
    }

    /**
     * Add schedule
     *
     * @param \Helit\Bundle\MyClassBundle\Entity\ScheduleItem $schedule
     * @return SchoolClass
     */
    public function addSchedule(\Helit\Bundle\MyClassBundle\Entity\ScheduleItem $schedule)
    {
        $this->schedule[] = $schedule;

        return $this;
    }

    /**
     * Remove schedule
     *
     * @param \Helit\Bundle\MyClassBundle\Entity\ScheduleItem $schedule
     */
    public function removeSchedule(\Helit\Bundle\MyClassBundle\Entity\ScheduleItem $schedule)
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
}
