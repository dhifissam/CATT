<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mission;
use AppBundle\Entity\PermisCirculation;
use AppBundle\Entity\Vehicule;
use AppBundle\Entity\VisiteTechnique;
use AppBundle\Entity\Voyage;
use AppBundle\Form\PermisCirculationType;
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
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $missionsToDay = $em->getRepository(Mission::class)->getMissionToDay();
        $missionsTommorow = $em->getRepository(Mission::class)->getMissionTomorrow();
        $visitesVehicule= $em->getRepository(VisiteTechnique::class)->getVisiteThisMonthVehicule();
        $visitesRemorque= $em->getRepository(VisiteTechnique::class)->getVisiteThisMonthRemorque();
        $permisVehicule= $em->getRepository(PermisCirculation::class)->getPermisThisMonthVehicule();
        $permisRemorque= $em->getRepository(PermisCirculation::class)->getPermisThisMonthRemorque();
        return $this->render('dashbord/index.html.twig',array(
            'missionsToDay'=>$missionsToDay,
            'missionsTommorow'=>$missionsTommorow,
            'visitesVehicule'=>$visitesVehicule,
            'visitesRemorque'=>$visitesRemorque,
            'permisVehicule'=>$permisVehicule,
            'permisRemorque'=>$permisRemorque
        ));
    }

    /**
     * @Route("/test", name="test")
     */
    public function testAction(Request $request)
    {
        return new Response();
    }
}
