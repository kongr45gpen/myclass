<?php

namespace Helit\Bundle\MyClassBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Helit\Bundle\MyClassBundle\Entity\ScheduleItem;

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
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $classIDs = $this->get('request')->query->get('classes', []);
        if (!is_array($classIDs)) {
            $classIDs = explode(',', $classIDs);
        }

        $classes  = $em->getRepository('HelitMyClassBundle:SchoolClass')->findById($classIDs);
        $schedule = $em->getRepository('HelitMyClassBundle:ScheduleItem')->getStudentSchedule($classes);


        return [
            'classes'  => $classes,
            'schedule' => $schedule,
        ];
    }
}
