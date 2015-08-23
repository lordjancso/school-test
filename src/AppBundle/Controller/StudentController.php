<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('default');

        $study_groups = $em->getRepository('AppBundle:StudyGroup')->findAll();
        $students = $em->getRepository('AppBundle:Student')->findAll();

        $paginator = $this->get('knp_paginator');
        $students = $paginator->paginate(
            $students,
            $request->query->getInt('page', 1),
            25
        );

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
