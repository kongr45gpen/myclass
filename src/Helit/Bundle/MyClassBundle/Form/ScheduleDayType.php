<?php

namespace Helit\Bundle\MyClassBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ScheduleDayType extends AbstractType
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
        foreach ($this->schedule as $hour => $item) {
            $builder->add(
                $builder->create(
                    'hour_'.$hour,
                    new ScheduleItemType())->setData($item)
            );
        }
    }

    /**
     * Create new ScheduleDayType
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
        return 'scheduleday';
    }
}
