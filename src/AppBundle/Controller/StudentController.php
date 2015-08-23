<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Student;
use AppBundle\Event\StudentEvent;
use AppBundle\Form\Type\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('default');

        $study_groups = $em->getRepository('AppBundle:StudyGroup')->findAll();

        if ($request->get('keyword') || $request->get('filters')) {
            if ($keyword = $request->get('keyword')) {
                $students = $em->getRepository('AppBundle:Student')->findByKeywordWithStudyGroup($keyword);
            } else {
                $filters = $request->get('filters');
                $students = $em->getRepository('AppBundle:Student')->findByFilterWithStudyGroup($filters);
            }
        } else {
            $students = $em->getRepository('AppBundle:Student')->findAllWithStudyGroup();
        }

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

    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('default');

        $student = new Student();
        $form = $this->createForm(new StudentType(), $student);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($student);
            $em->flush();

            $this->get('event_dispatcher')->dispatch('student.edit', new StudentEvent($student, 'create'));
            $this->addFlash('success', 'New student created successfully!');

            return $this->redirectToRoute('students.index');
        }

        return $this->render('student/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager('default');

        $student = $em->getRepository('AppBundle:Student')->find($id);

        if (!$student) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(new StudentType(), $student);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($student);
            $em->flush();

            $this->get('event_dispatcher')->dispatch('student.edit', new StudentEvent($student, 'edit'));
            $this->addFlash('success', 'New student edited successfully!');

            return $this->redirectToRoute('students.index');
        }

        return $this->render('student/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteAction(Request $request)
    {
        $ids = $request->get('ids');

        if (!$ids) {
            $this->addFlash('error', 'Select minimun one student first!');

            return $this->redirectToRoute('students.index');
        }

        $ids = explode(',', $ids);
        $em = $this->getDoctrine()->getManager('default');

        $students = $em->getRepository('AppBundle:Student')->findByIds($ids);

        foreach ($students as $student) {
            $em->remove($student);
        }

        $em->flush();

        $this->addFlash('success', 'Student(s) successfully deleted!');

        return $this->redirectToRoute('students.index');
    }
}
