<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\ScheduleItem;

/**
 * Schedule controller.
 *
 * @Route("/schedule")
 */
class ScheduleController extends Controller
{

    /**
     * Lists all ScheduleItem entities.
     *
     * @Route("/", name="schedule")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $classes  = $this->get('app.student_info.manager')->getClasses();
        $schedule = $em->getRepository('AppBundle:ScheduleItem')->getStudentSchedule($classes);

        return $this->render('schedule/index.html.twig', [
            'classes'  => $classes,
            'schedule' => $schedule,
        ]);
    }
}
