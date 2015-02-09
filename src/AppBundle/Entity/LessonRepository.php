<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ScheduleItemRepository
 *
 */
class LessonRepository extends EntityRepository
{
    /**
     * Get the list of lessons to show on the marks page
     *
     * @param  array    A list of orientations the user is a member of
     * @return Lesson[] The list of lessons
     */
    public function getGradedLessons($orientations)
    {
        return $this->createQueryBuilder('l')
            ->where('l.orientation in (:orientations)')
            ->leftJoin('l.group', 'g')
            ->orderBy('g.position')
            ->addOrderBy('l.position')
            ->setParameter('orientations', $orientations)
            ->getQuery()
            ->getResult();
    }
}
