<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Candidate
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Candidate
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
     * @var integer[]
     *
     * @ORM\Column(name="totalvotes", type="integer")
     */
    private $totalVotes;

    /**
     * @var integer[]
     *
     * @ORM\Column(name="votes", type="simple_array")
     */
    private $votes;

    /**
     * @var integer
     *
     * @ORM\Column(name="grade", type="integer")
     */
    private $grade;

    /**
     * @ORM\ManyToOne(targetEntity="Election", inversedBy="candidates")
     * @ORM\JoinColumn(nullable=false)
     */
    private $election;

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
     * @return Candidate
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
     * Set election
     *
     * @param \AppBundle\Entity\Election $election
     * @return Candidate
     */
    public function setElection(\AppBundle\Entity\Election $election)
    {
        $this->election = $election;

        return $this;
    }

    /**
     * Get election
     *
     * @return \AppBundle\Entity\Election
     */
    public function getElection()
    {
        return $this->election;
    }

    /**
     * Set votes
     *
     * @param array $votes
     * @return Candidate
     */
    public function setVotes($votes)
    {
        $this->votes = $votes;
        $this->totalVotes = array_sum($votes);

        return $this;
    }

    /**
     * Get votes
     *
     * @return array
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * Set grade
     *
     * @param integer $grade
     * @return Candidate
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade
     *
     * @return integer
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Get total votes
     *
     * @return integer
     */
    public function getTotalVotes()
    {
        return $this->totalVotes;
    }

    /**
     * Get the grades on which the candidate is most popular
     *
     * @return integer[]
     */
    public function getPopularOnGrades()
    {
        return array_keys($this->votes, max($this->votes));
    }
}
