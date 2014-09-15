<?php

namespace Helit\Bundle\MyClassBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LandingController extends Controller
{
    /**
     * @Route("/", name="helit_my_class_landing_index")
     * @Template()
     */
    public function indexAction()
    {
        // $repository = $this->getDoctrine()
            // ->getRepository('HelitMyClassBundle:Separation');

        // $result = $repository->createQueryBuilder('s')
            // ->where();

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT c FROM HelitMyClassBundle:SchoolClass c
            JOIN c.orientation or
            JOIN or.separation s
            JOIN s.orientations o
            GROUP BY c.id
            HAVING count(o) = 1'
        )->getResult();

        $separations = $em->getRepository('HelitMyClassBundle:Separation')->findAll();

        return array('classes' => $query, 'separations' => $separations);
    }
}
