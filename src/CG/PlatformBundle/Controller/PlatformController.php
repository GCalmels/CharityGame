<?php

namespace CG\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlatformController extends Controller
{
    public function homeAction()
    {
        return $this->render('CGPlatformBundle:Platform:home.html.twig');
    }
}
