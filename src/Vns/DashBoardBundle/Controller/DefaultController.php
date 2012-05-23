<?php

namespace Vns\DashBoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('VnsDashBoardBundle:Default:index.html.twig', array());
    }
}
