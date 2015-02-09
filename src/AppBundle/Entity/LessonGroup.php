<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LessonGroup
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class LessonGroup
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
     * @ORM\OneToMany(targetEntity="Lesson", mappedBy="group")
     */
    private $lessons;

    /**
     * @ORM\Column(name="position", type="integer")
     */
    private $position;


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
     * @return LessonGroup
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
        $this->lessons = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add lessons
     *
     * @param \AppBundle\Entity\Lesson $lessons
     * @return LessonGroup
     */
    public function addLesson(\AppBundle\Entity\Lesson $lessons)
    {
        $this->lessons[] = $lessons;

        return $this;
    }

    /**
     * Remove lessons
     *
     * @param \AppBundle\Entity\Lesson $lessons
     */
    public function removeLesson(\AppBundle\Entity\Lesson $lessons)
    {
        $this->lessons->removeElement($lessons);
    }

    /**
     * Get lessons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLessons()
    {
        return $this->lessons;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return LessonGroup
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }
}
