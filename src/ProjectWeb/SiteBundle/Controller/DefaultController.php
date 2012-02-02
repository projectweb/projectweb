<?php

namespace ProjectWeb\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('ProjectWebSiteBundle:Default:index.html.twig');
    }
}
