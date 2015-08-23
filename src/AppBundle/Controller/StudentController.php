<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StudentController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager('default');

        $study_groups = $em->getRepository('AppBundle:StudyGroup')->findAll();
        $students = $em->getRepository('AppBundle:Student')->findAll();

        return $this->render('student/index.html.twig', array(
            'study_groups' => $study_groups,
            'students' => $students
        ));
    }

    public function createAction()
    {
        return $this->render('student/index.html.twig');
    }
}
