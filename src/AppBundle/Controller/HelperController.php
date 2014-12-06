<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HelperController extends Controller
{
    public function navbarAction()
    {
        $separations = $this->getDoctrine()
            ->getRepository('AppBundle:Separation')
            ->findAll();

        $links = $this->getDoctrine()
            ->getRepository('AppBundle:Link')
            ->findAll();

        $elections = $this->getDoctrine()
            ->getRepository('AppBundle:Election')
            ->findAll();

        $request = $this->get('request_stack')->getMasterRequest();

        return $this->render('helper/navbar.html.twig', [
            'separations' => $separations,
            'links' => $links,
            'elections' => $elections,
            'request' => $request
        ]);
    }

}
