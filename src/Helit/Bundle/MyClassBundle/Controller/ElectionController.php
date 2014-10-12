<?php

namespace Helit\Bundle\MyClassBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Helit\Bundle\MyClassBundle\Entity\Election;

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
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('HelitMyClassBundle:Election')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Election entity.
     *
     * @Route("/{id}", name="elections_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
         $em = $this->getDoctrine()->getManager();

         $election = $em->getRepository('HelitMyClassBundle:Election')->find($id);

         if (!$election) {
             throw $this->createNotFoundException('Unable to find election.');
         }

         return array(
             'election'      => $election,
         );
    }
}
