<?php

namespace Helit\Bundle\MyClassBundle\Twig\Filter;

class RemoveAccentsFilter
{
    /**
     * Remove greek accents from a string
     *
     * @param string $string
     */
    public function __invoke($string)
    {
        return strtr($string, [
            'Ά' => 'α',
            'ά' => 'α',
            'Έ' => 'Ε',
            'ε' => 'ε',
            'Ή' => 'Η',
            'ή' => 'η',
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

}
