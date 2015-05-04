<?php

namespace Site\FirstBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SiteFirstBundle:Default:index.html.twig', array('name' => $name));
    }
}
