<?php

namespace Helit\Bundle\MyClassBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ScheduleItemRepository
 *
 */
class ScheduleItemRepository extends EntityRepository
{
    public function getStudentSchedule($classes)
    {
        $result = $this->createQueryBuilder('s')
            ->where('s.class in (:classes)')
            ->orderBy('s.day')
            ->addOrderBy('s.hour')
            ->setParameter('classes', $classes)
            ->getQuery()
            ->getResult();

        $schedule = array();

        foreach ($result as $item) {
            $schedule[$item->getDay()][$item->getHour()] = $item;
        }

        return $schedule;
    }
}
