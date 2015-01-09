<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
    public function listAction(Request $request)
    {
        $response = [
            'grades' => [
                [
                    'id' => 1,
                    'name' => 'Grade'
                ]
            ],
            'motd' => 'Version ' . (int) $request->query->get('version', 'unknown')
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
