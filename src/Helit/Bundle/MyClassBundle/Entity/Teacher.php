<?php

namespace Helit\Bundle\MyClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teacher
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Teacher
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
     * @ORM\OneToMany(targetEntity="ScheduleItem", mappedBy="teacher")
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
     * @return Teacher
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
     * Add schedule
     *
     * @param \Helit\Bundle\MyClassBundle\Entity\ScheduleItem $schedule
     * @return Teacher
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