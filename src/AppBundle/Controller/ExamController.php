<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Exam;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Exams controller.
 *
 * @Route("/exams")
 */
class ExamController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $orientations = $this->get('app.student_info.manager')->getOrientations();

        $exams = $em->getRepository('AppBundle:Exam')
            ->getExams($orientations);

        return $this->render('exam/index.html.twig', [
            'exams' => $exams,
        ]);
    }

    /**
     * @Route("/{id}")
     */
    public function showAction(Exam $exam)
    {
        return $this->render('exam/show.html.twig', [
            'exam' => $exam,
        ]);
    }
}
