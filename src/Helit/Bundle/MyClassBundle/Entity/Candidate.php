<?php

namespace Helit\Bundle\MyClassBundle\Entity;

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
     * @var integer
     *
     * @ORM\Column(name="total_votes", type="integer")
     */
    private $totalVotes;

    /**
     * @var array
     *
     * @ORM\Column(name="data", type="json_array")
     */
    private $data;

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
     * Set totalVotes
     *
     * @param integer $totalVotes
     * @return Candidate
     */
    public function setTotalVotes($totalVotes)
    {
        $this->totalVotes = $totalVotes;

        return $this;
    }

    /**
     * Get totalVotes
     *
     * @return integer 
     */
    public function getTotalVotes()
    {
        return $this->totalVotes;
    }

    /**
     * Set data
     *
     * @param array $data
     * @return Candidate
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return array 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get grade
     *
     * @return int
     */
    public function getGrade()
    {
        return $this->data['class'];
    }

    /**
     * Set election
     *
     * @param \Helit\Bundle\MyClassBundle\Entity\Election $election
     * @return Candidate
     */
    public function setElection(\Helit\Bundle\MyClassBundle\Entity\Election $election)
    {
        $this->election = $election;

        return $this;
    }

    /**
     * Get election
     *
     * @return \Helit\Bundle\MyClassBundle\Entity\Election 
     */
    public function getElection()
    {
        return $this->election;
    }
}
