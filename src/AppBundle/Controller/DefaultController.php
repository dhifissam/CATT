<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Vehicule;
use AppBundle\Entity\Voyage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="dashbord")
     */
    public function indexAction(Request $request)
    {
        return $this->render('dashbord/index.html.twig');
    }

    /**
     * @Route("/test", name="test")
     */
    public function testAction(Request $request)
    {
        return new Response();
    }
}
