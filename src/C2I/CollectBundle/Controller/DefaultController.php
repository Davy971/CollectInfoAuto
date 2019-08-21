<?php

namespace C2I\CollectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('C2ICollectBundle:Default:index.html.twig');
    }
}
