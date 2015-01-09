<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/api")
 */
class APIController extends Controller
{
    /**
     * @Route("/getInfo")
     * @Route("/getInfo.php") for backwards compatibility
     */
    public function listAction()
    {
        $response = [
            'grades' => [
                [
                    'id' => 1,
                    'name' => 'Grade'
                ]
            ]
        ];

        $response['grades'][0]['separations'] = $this->getDoctrine()
            ->getRepository('AppBundle:Separation')
            ->findAll();

        $response['teachers'] = $this->getDoctrine()
            ->getRepository('AppBundle:Teacher')
            ->findAll();

        $serializer = $this->container->get('jms_serializer');
        $json = $serializer->serialize($response, 'json');

        return (new JsonResponse())->setContent($json);
    }

}
