<?php

namespace Helit\Bundle\MyClassBundle\Form;

use Helit\Bundle\MyClassBundle\Entity\ScheduleItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ScheduleItemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', 'choice', [
                'choices' => [
                    ScheduleItem::STATUS_DISABLED => 'disabled',
                    ScheduleItem::STATUS_UNKNOWN  => 'unknown',
                    ScheduleItem::STATUS_ENABLED  => 'enabled'
                ]
            ])
            ->add('room')
            ->add('class', null, [
                'empty_value' => 'None',
                'required' => false
            ])
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Helit\Bundle\MyClassBundle\Entity\ScheduleItem',
            'label' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'scheduleitem';
    }
}
