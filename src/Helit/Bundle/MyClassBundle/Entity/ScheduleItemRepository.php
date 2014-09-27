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

    public function getTeacherSchedule($teacher)
    {
        $result = $this->createQueryBuilder('s')
            ->where('s.teacher = :teacher')
            ->setParameter('teacher', $teacher)
            ->getQuery()
            ->getResult();

        return $this->chunk($result, $teacher);
    }

    /**
     * Prepares the schedule for the form
     *
     * @param array $schedule The result of the schedule query
     * @param Teacher $teacher The teacher
     * @return array
     */
    private function chunk($schedule, $teacher)
    {
        $return = array();

        foreach ($schedule as $item) {
            $return[$item->getDay()][$item->getHour()] = $item;
        }

        for ($day = ScheduleItem::DAY_MONDAY; $day <= ScheduleItem::DAY_FRIDAY; $day++) {
            for ($hour = 1; $hour <= 7; $hour++) {
                if (!isset($return[$day][$hour])) {
                    $return[$day][$hour] = (new ScheduleItem())
                        ->setDay($day)
                        ->setHour($hour)
                        ->setTeacher($teacher)
                        ->setRoom($teacher->getFavoriteRoom());
                }
            }
        }

        $this->recursiveKsort($return);

        return $return;
    }

    /**
     * Recursive key sort
     *
     * @param array $array The array to be sorted
     *
     * @return bool Returns `TRUE` on success or `FALSE` on failure.
     */
    private function recursiveKsort(array &$array) {
        foreach ($array as &$value) {
            if (is_array($value)) {
                $this->recursiveKsort($value);
            }
        }

        return ksort($array);
    }
}
