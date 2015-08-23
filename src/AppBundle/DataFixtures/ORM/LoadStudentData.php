<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Student;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadStudentData implements FixtureInterface, DependentFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 125; $i++) {
            if (mt_rand(0, 1)) {
                $gender = 'Male';
            } else {
                $gender = 'Female';
            }

            $birthday = mt_rand(-315622800, 662598000);
            $birthday = new \DateTime(date('Y-m-d', $birthday));

            $student = new Student();
            $student->setName($this->generateRandomString() . ' Student ' . $i);
            $student->setGender($gender);
            $student->setBirthplace('City ' . $i);
            $student->setBirthday($birthday);
            $student->setEmail('student' . $i . '@gmail.com');

            $ids = array();
            for ($j = 0; $j < mt_rand(1, 4); $j++) {
                $ids[] = mt_rand(1, 6);
            }
            $ids = array_unique($ids);

            foreach ($ids as $id) {
                $study_group = $manager->getReference('AppBundle\Entity\StudyGroup', $id);

                $student->addStudyGroup($study_group);
            }

            $manager->persist($student);
        }

        $manager->flush();
    }

    private function generateRandomString($length = 3)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * {@inheritDoc}
     */
    public function getDependencies()
    {
        return array(
            'AppBundle\DataFixtures\ORM\LoadStudyGroupData'
        );
    }
}
