<?php

namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('removeAccents', array($this, 'removeAccents')),
        );
    }

    /**
     * Remove greek accents from a string
     *
     * @param string $string
     */
    public function removeAccents($string)
    {
        return strtr($string, [
            'Ά' => 'α',
            'ά' => 'α',
            'Έ' => 'Ε',
            'ε' => 'ε',
            'Ή' => 'Η',
            'ή' => 'η',
            'Ί' => 'Ι',
            'ί' => 'ι',
            'Ό' => 'Ο',
            'ό' => 'ο',
            'Ύ' => 'Υ',
            'ύ' => 'υ',
            'Ώ' => 'Ω',
            'ώ' => 'ω',
            'ΰ' => 'ϋ',
            'ΐ' => 'ϊ'
        ]);
    }

    public function getName()
    {
        return 'app_extension';
    }
}
