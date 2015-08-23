<?php

namespace AppBundle\Event;

use AppBundle\Entity\Student;
use Symfony\Component\EventDispatcher\Event;

class StudentEvent extends Event
{
    protected $student;
    protected $type;

    public function __construct(Student $student, $type)
    {
        $this->student = $student;
        $this->type = $type;
    }

    public function getStudent()
    {
        return $this->student;
    }

    public function getType()
    {
        return $this->type;
    }
}
