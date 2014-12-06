<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Election;

/**
 * Election controller.
 *
 * @Route("/elections")
 */
class ElectionController extends Controller
{

    /**
     * Lists all Election entities.
     *
     * @Route("/", name="elections")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Election')->findAll();

        return $this->render('election/index.html.twig', [
            'entities' => $entities,
        ]);
    }

    /**
     * Finds and displays a Election entity.
     *
     * @Route("/{id}", name="elections_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
         $em = $this->getDoctrine()->getManager();

         $election = $em->getRepository('AppBundle:Election')->find($id);

         if (!$election) {
             throw $this->createNotFoundException('Unable to find election.');
         }

         return $this->render('election/show.html.twig', [
             'election' => $election,
         ]);
    }
}
