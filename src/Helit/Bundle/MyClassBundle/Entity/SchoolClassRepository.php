<?php

namespace Helit\Bundle\MyClassBundle\Entity;

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
                FROM HelitMyClassBundle:SchoolClass pc
                WHERE c = pc AND pc in (:prioritizedClasses)
            ) as HIDDEN priority
            FROM HelitMyClassBundle:SchoolClass c
            JOIN c.orientation o
            JOIN o.separation s
            WHERE c in (:classes)
            GROUP BY c.id
            ORDER BY priority ASC'
            )->setParameter('classes', array_merge($cookieClasses, $requestClasses))
            ->setParameter('prioritizedClasses', $requestClasses)
            ->getResult();
    }
}
