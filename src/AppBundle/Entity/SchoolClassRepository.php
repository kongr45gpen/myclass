<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SchoolClassRepository
 *
 */
class SchoolClassRepository extends EntityRepository
{
    public function getStudentClasses($cookieClasses, $requestClasses)
    {
        return $this->getEntityManager()->createQuery(
            'SELECT c.id as class,
            s.id as separation,
            (
                SELECT count(pc)
                FROM AppBundle:SchoolClass pc
                WHERE c = pc AND pc in (:prioritizedClasses)
            ) as HIDDEN priority
            FROM AppBundle:SchoolClass c
            JOIN c.orientation o
            JOIN o.separation s
            WHERE c in (:classes) OR c.default = 1
            GROUP BY c.id
            ORDER BY priority ASC, c.default DESC'
        )->setParameter('classes', array_merge($cookieClasses, $requestClasses))
            ->setParameter('prioritizedClasses', $requestClasses)
            ->getResult();
    }
}
