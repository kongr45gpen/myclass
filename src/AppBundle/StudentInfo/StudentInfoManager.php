<?php

namespace AppBundle\StudentInfo;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Separation;
use AppBundle\Entity\SchoolClass;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class StudentInfoManager
{
    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     *
     */
    private $classes = array();

    public function __construct(RequestStack $requestStack, EntityManager $entityManager)
    {
        $this->requestStack = $requestStack;
        $this->entityManager = $entityManager;
    }

    public function getClass(Separation $separation)
    {
        return $this->entityManager
            ->getRepository('AppBundle:SchoolClass')
            ->find($this->classes[$separation->getId()]);
    }

    public function getClasses()
    {
        return $this->entityManager
            ->getRepository('AppBundle:SchoolClass')
            ->findById($this->classes);
    }

    public function isSelected(SchoolClass $class, Separation $separation=null)
    {
        if (!array_key_exists($separation->getId(), $this->classes)) {
            return false;
        } elseif ($separation) {
            return $this->classes[$separation->getId()] == $class->getId();
        } else {
            return in_array($class->getId(), $this->classes);
        }
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            // don't do anything if it's not the master request
            return;
        }

        $request = $event->getRequest();
        $requestClasses = explode(',', $request->query->get('classes'));
        $cookieClasses  = explode(',', $request->cookies->get('classes'));

        $query = $this->entityManager
            ->getRepository('AppBundle:SchoolClass')
            ->getStudentClasses($cookieClasses, $requestClasses);

        $this->classes = array_column($query, 'class', 'separation');
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        $cookie = new Cookie('classes', implode(',', $this->classes), "next year");

        $event->getResponse()->headers->setCookie($cookie);
    }
}
