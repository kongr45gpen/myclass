<?php

namespace AppBundle\Entity;

/**
 * ExamRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ExamRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Get the list of exams for a user
     *
     * @param  array    A list of orientations the user is a member of
     * @return Exam[] The list of exams
     */
    public function getExams($orientations)
    {
        return $this->createQueryBuilder('e')
	    ->leftJoin('e.lesson', 'l')
            ->where('l.orientation in (:orientations)')
            ->orderBy('e.date')
            ->setParameter('orientations', $orientations)
            ->getQuery()
            ->getResult();
    }
}
