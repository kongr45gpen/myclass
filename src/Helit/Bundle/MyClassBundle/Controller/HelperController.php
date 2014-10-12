<?php

namespace Helit\Bundle\MyClassBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HelperController extends Controller
{
    /**
     * @Template()
     */
    public function navbarAction()
    {
        $separations = $this->getDoctrine()
            ->getRepository('HelitMyClassBundle:Separation')
            ->findAll();

        $links = $this->getDoctrine()
            ->getRepository('HelitMyClassBundle:Link')
            ->findAll();

        $elections = $this->getDoctrine()
            ->getRepository('HelitMyClassBundle:Election')
            ->findAll();

        $request = $this->get('request_stack')->getMasterRequest();

        return [
            'separations' => $separations,
            'links' => $links,
            'elections' => $elections,
            'request' => $request
        ];
    }

}
