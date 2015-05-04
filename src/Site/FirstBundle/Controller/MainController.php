<?php

namespace Site\FirstBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('SiteFirstBundle:Main:index.html.twig');
    }
}
