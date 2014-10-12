<?php

namespace Helit\Bundle\MyClassBundle\Entity;

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
     * @var array
     *
     * @ORM\Column(name="data", type="json_array")
     */
    private $data;

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
     * Set data
     *
     * @param array $data
     * @return Election
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
     * Get green colour threshold
     *
     * @return int
     */
    public function getGreenThreshold()
    {
        return $this->data('greenThreshold', 15);
        return (isset($this->data['greenThreshold'])) ? $this->data['greenThreshold'] : 15;
    }

    /**
     * Get yellow colour threshold
     *
     * @return int
     */
    public function getYellowThreshold()
    {
        return $this->data('yellowThreshold', 18);
    }

    /**
     * Get valid ballot count
     *
     * @return int
     */
    public function getValidBallots()
    {
        return $this->data('validBallots', 0);
    }

    /**
     * Get invalid ballot count
     *
     * @return int
     */
    public function getInvalidBallots()
    {
        return $this->data('invalidBallots', 0);
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
     * @param \Helit\Bundle\MyClassBundle\Entity\Candidate $candidates
     * @return Election
     */
    public function addCandidate(\Helit\Bundle\MyClassBundle\Entity\Candidate $candidates)
    {
        $this->candidates[] = $candidates;

        return $this;
    }

    /**
     * Remove candidates
     *
     * @param \Helit\Bundle\MyClassBundle\Entity\Candidate $candidates
     */
    public function removeCandidate(\Helit\Bundle\MyClassBundle\Entity\Candidate $candidates)
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
     * Get value from data
     *
     * @param string $key The data array key
     * @param mixed  $default The default value to return
     *
     * @return mixed
     */
    private function data($key, $default = null) {
        return (isset($this->data[$key])) ? $this->data[$key] : $default;
    }
}
