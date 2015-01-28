<?php

namespace AppBundle\Form;

use AppBundle\Entity\ScheduleItem;
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
            if ($item->getStatus() === ScheduleItem::STATUS_UNKNOWN) {
                $class = 'warning';
            } elseif ($item->getClass() !== null) {
                if ($item->getStatus() === ScheduleItem::STATUS_ENABLED) {
                    $class = 'active';
                } else {
                    $class = 'negative';
                }
            } else {
                $class = '';
            }

            $builder->add(
                $builder->create(
                    'hour_'.$hour,
                    new ScheduleItemType(),
                    ['attr' => ['class' => $class]]
                )->setData($item)
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
