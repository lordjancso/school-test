<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class StudentRepository extends EntityRepository
{
    public function findAllWithStudyGroup()
    {
        $students = $this->createQueryBuilder('s')
            ->select('s', 'g')
            ->leftJoin('s.studyGroups', 'g')
            ->getQuery()
            ->getResult();

        return $students;
    }

    public function findByKeywordWithStudyGroup($keyword)
    {
        $students = $this->createQueryBuilder('s')
            ->select('s', 'g')
            ->leftJoin('s.studyGroups', 'g')
            ->where('s.name LIKE :name')
            ->setParameter('name', $keyword . '%')
            ->getQuery()
            ->getResult();

        return $students;
    }
}
