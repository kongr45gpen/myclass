<?php

namespace Helit\Bundle\MyClassBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Helit\Bundle\MyClassBundle\Entity\ScheduleItem;
use Helit\Bundle\MyClassBundle\Form\ScheduleItemType;
use Helit\Bundle\MyClassBundle\Form\ScheduleDayType;
use Helit\Bundle\MyClassBundle\Form\ScheduleType;
use Helit\Bundle\MyClassBundle\Entity\Teacher;

/**
 * Admin controller.
 *
 * @Route("/admin")
 */
class AdminController extends Controller
{

    /**
     * Edit the schedule for a teacher
     *
     * @Route("/schedule/{teacher}", name="admin")
     * @Template()
     */
    public function scheduleAction(Request $request, Teacher $teacher)
    {
        $em = $this->getDoctrine()->getManager();

        $schedule = $em->getRepository('HelitMyClassBundle:ScheduleItem')->getTeacherSchedule($teacher);

        $entity = new ScheduleItem();
        $form = $this->createCreateForm($schedule);
        $form->handleRequest($request);

        if ($form->isValid()) {
            foreach ($form as $day) {
                if ($day->getConfig()->getType()->getName() != 'scheduleday') {
                    continue;
                }

                foreach ($day as $hour) {
                    $entity = $hour->getData();

                    if ($entity->getClass() === null) {
                        $em->remove($entity);
                    } else {
                        $em->persist($entity);
                    }
                }
            }

            $em->flush();
            $request->getSession()->getFlashBag()->add('success',
                'The schedule has been stored successfully.'
            );
        }

        return array(
            'teacher' => $teacher,
            'schedule' => $schedule,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to edit the schedule.
     *
     * @param array $schedule The schedule
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(array $schedule)
    {
        $form = $this->createForm(new ScheduleType($schedule), null, array(
            'method' => 'POST',
        ));

        $form->add('submit', 'submit');

        return $form;
    }
}
