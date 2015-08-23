<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\StudyGroup;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadStudyGroupData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $study_group = new StudyGroup();
        $study_group->setName('Typography');
        $study_group->setTeacher('Teacher 1');
        $study_group->setSubject('English');
        $study_group->setDate('Monday');
        $manager->persist($study_group);

        $study_group = new StudyGroup();
        $study_group->setName('Biologists');
        $study_group->setTeacher('Teacher 2');
        $study_group->setSubject('Biology');
        $study_group->setDate('Tuesday');
        $manager->persist($study_group);

        $study_group = new StudyGroup();
        $study_group->setName('Chemistry Capital');
        $study_group->setTeacher('Teacher 3');
        $study_group->setSubject('Chemistry');
        $study_group->setDate('Wednesday');
        $manager->persist($study_group);

        $study_group = new StudyGroup();
        $study_group->setName('Web designers');
        $study_group->setTeacher('Teacher 4');
        $study_group->setSubject('Computing');
        $study_group->setDate('Thursday');
        $manager->persist($study_group);

        $study_group = new StudyGroup();
        $study_group->setName('Black magicians');
        $study_group->setTeacher('Teacher 5');
        $study_group->setSubject('Math');
        $study_group->setDate('Friday');
        $manager->persist($study_group);

        $study_group = new StudyGroup();
        $study_group->setName('Lame gamer boys');
        $study_group->setTeacher('Teacher 6');
        $study_group->setSubject('Sport');
        $study_group->setDate('Thursday');
        $manager->persist($study_group);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
