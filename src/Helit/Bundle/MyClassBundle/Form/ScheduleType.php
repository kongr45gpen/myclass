<?php

namespace Helit\Bundle\MyClassBundle\Form;

use Helit\Bundle\MyClassBundle\Entity\ScheduleItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ScheduleType extends AbstractType
{
    /**
     * @var array
     */
    protected $schedule;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach ($this->schedule as $day => $schedule) {
            $builder->add(
                "day_$day",
                new ScheduleDayType($schedule)
            );
        }
    }

    /**
     * Create new ScheduleType
     *
     * @param array $schedule The schedule
     */
    public function __construct($schedule)
    {
        $this->schedule = $schedule;
    }

    public function getParent()
    {
        return 'form';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'schedule';
    }
}
