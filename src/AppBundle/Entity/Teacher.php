<?php

namespace AppBundle\Entity;

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
     * @var integer
     *
     * @ORM\Column(name="favorite_room", type="smallint")
     */
    private $favoriteRoom = 0;

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
     * @param \AppBundle\Entity\ScheduleItem $schedule
     * @return Teacher
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
     * Set favorite room
     *
     * @param integer $favoriteRoom
     * @return Teacher
     */
    public function setFavoriteRoom($favoriteRoom)
    {
        $this->favoriteRoom = $favoriteRoom;

        return $this;
    }

    /**
     * Get favorite room
     *
     * @return integer
     */
    public function getFavoriteRoom()
    {
        return $this->favoriteRoom;
    }
}
