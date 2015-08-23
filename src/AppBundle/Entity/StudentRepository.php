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

    public function findByFilterWithStudyGroup($filters)
    {
        $students = $this->createQueryBuilder('s')
            ->select('s', 'g')
            ->join('s.studyGroups', 'g')
            ->where('g.id IN (:filters)')
            ->setParameter('filters', $filters)
            ->getQuery()
            ->getResult();

        return $students;
    }

    public function findByIds(array $ids)
    {
        $students = $this->createQueryBuilder('s')
            ->where('s.id IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();

        return $students;
    }
}
