<?php

namespace AppBundle\Entity;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;

/**
 * Exam
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ExamRepository")
 */
class Exam
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * Duration in hours
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer")
     */
    private $duration = 2;

    /**
     * @ORM\ManyToOne(targetEntity="Lesson", inversedBy="exams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lesson;

    /**
     * @ORM\OneToMany(targetEntity="Syllabus", mappedBy="exam", cascade={"persist", "remove"})
     */
    private $syllabi;


    /**
     * Construct new Exam
     */
    public function __construct()
    {
        $this->date = Carbon::now();
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Exam
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return Carbon
     */
    public function getDate()
    {
        return $this->date ? Carbon::instance($this->date) : null;
    }

    /**
     * Get ending date
     *
     * @return Carbon
     */
    public function getEndDate()
    {
        return $this->getDate()->copy()->addHours($this->duration);
    }

    /**
     * Set lesson
     *
     * @param \AppBundle\Entity\Lesson $lesson
     *
     * @return Exam
     */
    public function setLesson(\AppBundle\Entity\Lesson $lesson)
    {
        $this->lesson = $lesson;

        return $this;
    }

    /**
     * Get lesson
     *
     * @return \AppBundle\Entity\Lesson
     */
    public function getLesson()
    {
        return $this->lesson;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return Exam
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Add syllabus
     *
     * @param \AppBundle\Entity\Syllabus $syllabus
     *
     * @return Exam
     */
    public function addSyllabus(\AppBundle\Entity\Syllabus $syllabus)
    {
        $this->syllabi[] = $syllabus;

        return $this;
    }

    /**
     * Remove syllabus
     *
     * @param \AppBundle\Entity\Syllabus $syllabus
     */
    public function removeSyllabus(\AppBundle\Entity\Syllabus $syllabus)
    {
        $this->syllabi->removeElement($syllabus);
    }

    /**
     * Get syllabi
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSyllabi()
    {
        return $this->syllabi;
    }

    /**
     * Convert to string
     *
     * @return string
     */
    public function __toString()
    {
        if (!$this->lesson) {
            return '';
        }

        if (!$this->date) {
            return $this->lesson->getName();
        }

        return $this->lesson->getName() . ' ' . $this->getDate()->toDateTimeString();
    }
}
