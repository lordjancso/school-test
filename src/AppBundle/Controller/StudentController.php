<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StudentController extends Controller
{
    public function indexAction()
    {
        return $this->render('student/index.html.twig');
    }

    public function createAction()
    {
        return $this->render('student/index.html.twig');
    }
}
