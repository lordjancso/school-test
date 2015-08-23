<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class StudentRepository extends EntityRepository
{
    public function findByKeyword($keyword)
    {
        $students = $this->createQueryBuilder('s')
            ->where('s.name LIKE :name')
            ->setParameter('name', $keyword . '%')
            ->getQuery()
            ->getResult();

        return $students;
    }
}
