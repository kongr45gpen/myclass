<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lesson
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\LessonRepository")
 */
class Lesson
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
     * @var boolean
     *
     * @ORM\Column(name="graded", type="boolean")
     */
    private $graded = true;

    /**
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="Orientation", inversedBy="lessons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orientation;

    /**
     * @ORM\ManyToOne(targetEntity="LessonGroup", inversedBy="lessons")
     */
    private $group;


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
     * @return Lesson
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
     * Set graded
     *
     * @param boolean $graded
     * @return Lesson
     */
    public function setGraded($graded)
    {
        $this->graded = $graded;

        return $this;
    }

    /**
     * Get graded
     *
     * @return boolean
     */
    public function isGraded()
    {
        return $this->graded;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Lesson
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

    /**
     * Set orientation
     *
     * @param \AppBundle\Entity\Orientation $orientation
     * @return Lesson
     */
    public function setOrientation(\AppBundle\Entity\Orientation $orientation)
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
     * Set group
     *
     * @param \AppBundle\Entity\LessonGroup $group
     * @return Lesson
     */
    public function setGroup(\AppBundle\Entity\LessonGroup $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \AppBundle\Entity\LessonGroup
     */
    public function getGroup()
    {
        return $this->group;
    }
}
