<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ScheduleItem;
use AppBundle\Form\ScheduleType;
use AppBundle\Entity\Teacher;

/**
 * Admin controller.
 *
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * Index for the administration panel
     *
     * @Route("/", name="admin")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $teachers = $em->getRepository('AppBundle:Teacher')
            ->findAll();

        return $this->render('admin/teachers.html.twig', [
            'teachers' => $teachers,
        ]);
    }

    /**
     * Edit the schedule for a teacher
     *
     * @Route("/schedule/{teacher}", name="admin_schedule")
     */
    public function scheduleAction(Request $request, Teacher $teacher)
    {
        $em = $this->getDoctrine()->getManager();

        $schedule = $em->getRepository('AppBundle:ScheduleItem')
            ->getTeacherSchedule($teacher);

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

            // Regenerate the form
            $form = $this->createCreateForm($schedule);
        }

        return $this->render('admin/schedule.html.twig', [
            'teacher' => $teacher,
            'schedule' => $schedule,
            'form'   => $form->createView(),
        ]);
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
