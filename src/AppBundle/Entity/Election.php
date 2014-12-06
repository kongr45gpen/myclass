<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Election
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Election
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
     * @ORM\Column(name="green_threshold", type="integer")
     */
    private $greenThreshold = 18;

    /**
     * @var integer
     *
     * @ORM\Column(name="yellow_threshold", type="integer")
     */
    private $yellowThreshold = 15;

    /**
     * @var integer
     *
     * @ORM\Column(name="valid_ballots", type="integer")
     */
    private $validBallots;

    /**
     * @var integer
     *
     * @ORM\Column(name="invalid_ballots", type="integer")
     */
    private $invalidBallots;

    /**
     * @ORM\OneToMany(targetEntity="Candidate", mappedBy="election")
     * @ORM\OrderBy({"totalVotes" = "DESC"})
     */
    private $candidates;


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
     * @return Election
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
     * Get total ballot count
     *
     * @return int
     */
    public function getBallots()
    {
        return $this->getValidBallots() + $this->getInvalidBallots();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->candidates = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add candidates
     *
     * @param \AppBundle\Entity\Candidate $candidates
     * @return Election
     */
    public function addCandidate(\AppBundle\Entity\Candidate $candidates)
    {
        $this->candidates[] = $candidates;

        return $this;
    }

    /**
     * Remove candidates
     *
     * @param \AppBundle\Entity\Candidate $candidates
     */
    public function removeCandidate(\AppBundle\Entity\Candidate $candidates)
    {
        $this->candidates->removeElement($candidates);
    }

    /**
     * Get candidates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCandidates()
    {
        return $this->candidates;
    }

    /**
     * Set greenThreshold
     *
     * @param integer $greenThreshold
     * @return Election
     */
    public function setGreenThreshold($greenThreshold)
    {
        $this->greenThreshold = $greenThreshold;

        return $this;
    }

    /**
     * Get greenThreshold
     *
     * @return integer
     */
    public function getGreenThreshold()
    {
        return $this->greenThreshold;
    }

    /**
     * Set yellowThreshold
     *
     * @param integer $yellowThreshold
     * @return Election
     */
    public function setYellowThreshold($yellowThreshold)
    {
        $this->yellowThreshold = $yellowThreshold;

        return $this;
    }

    /**
     * Get yellowThreshold
     *
     * @return integer
     */
    public function getYellowThreshold()
    {
        return $this->yellowThreshold;
    }

    /**
     * Set validBallots
     *
     * @param integer $validBallots
     * @return Election
     */
    public function setValidBallots($validBallots)
    {
        $this->validBallots = $validBallots;

        return $this;
    }

    /**
     * Get validBallots
     *
     * @return integer
     */
    public function getValidBallots()
    {
        return $this->validBallots;
    }

    /**
     * Set invalidBallots
     *
     * @param integer $invalidBallots
     * @return Election
     */
    public function setInvalidBallots($invalidBallots)
    {
        $this->invalidBallots = $invalidBallots;

        return $this;
    }

    /**
     * Get invalidBallots
     *
     * @return integer
     */
    public function getInvalidBallots()
    {
        return $this->invalidBallots;
    }

    /**
     * Gets the grade distribution of votes
     *
     * @return array [ voting_grade => [ voted_grade => vote_count ])
     */
    public function getVoteGradeDistribution()
    {
        $return = [];

        foreach ($this->candidates as $candidate) {
            foreach ($candidate->getVotes() as $voteGrade => $votes) {
                if (isset($return[$candidate->getGrade()][$voteGrade])) {
                    $return[$candidate->getGrade()][$voteGrade] += $votes;
                } else {
                    $return[$candidate->getGrade()][$voteGrade] = $votes;
                }
            }
        }

        return $return;
    }
}
