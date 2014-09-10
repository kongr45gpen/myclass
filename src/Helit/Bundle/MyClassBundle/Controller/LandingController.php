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
        return array();
    }
}
