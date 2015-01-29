<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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

        $days = $em->getRepository('AppBundle:Day')->findAll();
        $classes = $this->get('app.student_info.manager')->getClasses();
        $schedule = $em->getRepository('AppBundle:ScheduleItem')->getStudentSchedule($classes);

        // Make sure that $days starts from key 1
        array_unshift($days, null);
        unset($days[0]);

        return $this->render('schedule/index.html.twig', [
            'classes' => $classes,
            'days' => $days,
            'schedule' => $schedule,
        ]);
    }
}
