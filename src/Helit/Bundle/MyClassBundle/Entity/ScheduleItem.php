<?php

namespace Helit\Bundle\MyClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ScheduleItem
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Helit\Bundle\MyClassBundle\Entity\ScheduleItemRepository")
 */
class ScheduleItem
{
    const DAY_MONDAY = 1;
    const DAY_TUESDAY = 2;
    const DAY_WEDNESDAY = 3;
    const DAY_THURSDAY = 4;
    const DAY_FRIDAY = 5;

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;
    const STATUS_UNKNOWN = 2;


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
     * @ORM\Column(name="day", type="smallint")
     */
    private $day;

    /**
     * @var integer
     *
     * @ORM\Column(name="hour", type="smallint")
     */
    private $hour;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="room", type="smallint")
     */
    private $room;


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
     * Set day
     *
     * @param integer $day
     * @return ScheduleItem
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return integer 
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set hour
     *
     * @param integer $hour
     * @return ScheduleItem
     */
    public function setHour($hour)
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * Get hour
     *
     * @return integer 
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return ScheduleItem
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set room
     *
     * @param integer $room
     * @return ScheduleItem
     */
    public function setRoom($room)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return integer 
     */
    public function getRoom()
    {
        return $this->room;
    }
}
