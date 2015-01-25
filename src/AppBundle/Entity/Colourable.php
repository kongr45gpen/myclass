<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Support for colours in entities
 */
trait Colourable {
    /**
     * @var string
     *
     * @Serializer\Accessor(getter="getMobileColour")
     * @Serializer\SerializedName("color")
     * @ORM\Column(name="colour", type="string", length=15, nullable=true)
     */
    protected $colour;

    /**
     * Set colour
     *
     * @param string $colour
     * @return Orientation
     */
    public function setColour($colour)
    {
        $this->colour = $colour;

        return $this;
    }

    /**
     * Get colour
     *
     * @return string
     */
    public function getColour()
    {
        return $this->colour;
    }

    /**
     * Get the colour in a format readable by the Android app
     *
     * @return string
     */
    public function getMobileColour()
    {
        static $colours = [
            'black'  => '#000000',
            'yellow' => '#F2C61F',
            'green'  => '#5BBD72',
            'blue'   => '#3B83C0',
            'orange' => '#E07B53',
            'purple' => '#a3a3ff',
            'red'    => '#D95C5C',
            'pink'   => '#D9499A',
            'teal'   => '#00B5AD',
        ];

        if (null === $this->colour) {
            return '';
        } elseif (isset($colours[$this->colour])) {
            return $colours[$this->colour];
        }

        return $this->colour;
    }
}
