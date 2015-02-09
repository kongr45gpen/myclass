<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Election controller.
 *
 * @Route("/marks")
 * @Route("/vathmoi")
 */
class MarksController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();

        $orientations = $this->get('app.student_info.manager')->getOrientations();

        $lessons = $em->getRepository('AppBundle:Lesson')
            ->getGradedLessons($orientations);

        return $this->render('marks/show.html.twig', [
            'lessons' => $lessons,
        ]);
    }

}
