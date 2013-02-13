<?php

namespace Kitpages\MobileAppBuilderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('KitpagesMobileAppBuilderBundle:Default:index.html.twig', array('name' => $name));
    }
}
