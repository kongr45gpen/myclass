<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Orientation;
use AppBundle\Entity\SchoolClass;
use AppBundle\Entity\Separation;
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
    private static $defaultClasses = [1, 5, 10, 12, 17, 21, 26];

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

        $this->fillDefault($response);

        $serializer = $this->container->get('jms_serializer');
        $json = $serializer->serialize($response, 'json');

        return (new JsonResponse())->setContent($json);
    }

    /**
     * Fill the response with the default class IDs (if they don't exist already)
     * so that app versions with hardcoded defaults don't crash
     *
     * @param array $response The response
     */
    private function fillDefault(array &$response)
    {
        $classes = $this->getDoctrine()
            ->getRepository('AppBundle:SchoolClass')
            ->createQueryBuilder('c')
            ->select('c.id')
            ->where('c.id in (:ids)')
            ->setParameter('ids', static::$defaultClasses)
            ->getQuery()
            ->getResult();

        $missing = array_diff(static::$defaultClasses, array_map('current', $classes));

        if(empty($missing)) {
            return;
        }

        $orientation = new Orientation();
        $separation = new Separation();

        $orientation
            ->setName('')
            ->setFullName('')
            ->setColour('');

        $separation
            ->setName('')
            ->setFullName('')
            ->setColour('');

        $separation->addOrientation($orientation);
        $orientation->setSeparation($separation);

        $this->setId($separation);
        $this->setId($orientation);

        foreach($missing as $id) {
            $class = new SchoolClass();
            $this->setId($class, $id);
            $class->setName('');
            $class->setOrientation($orientation);
            $class->setDefault(false);

            $orientation->addClass($class);
        }

        $response['grades'][] = [
            'id' => 2,
            'name' => '',
            'separations' => [$separation]
        ];
    }

    /**
     * Sets the ID of an entity
     *
     * @param object $object The entity
     * @param int $id The ID
     */
    private function setId($object, $id = 0) {
        $refObject   = new \ReflectionObject($object);
        $refProperty = $refObject->getProperty('id');
        $refProperty->setAccessible(true);
        $refProperty->setValue($object, $id);
    }
}
