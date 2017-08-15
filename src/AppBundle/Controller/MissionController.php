<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mission;
use AppBundle\Form\MissionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/mission")
 */
class MissionController extends Controller
{

    /**
     * @Route("/", name="mission_list")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $missions = $em->getRepository(Mission::class)->findAll();
        return $this->render(":mission:list.html.twig", array(
            "missions" => $missions
        ));
    }

    /**
     * @Route("/form/{id}", name="mission_form")
     */
    public function formAction(Request $request, $id = null)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        if ($id) {
            $mission = $em->getRepository(Mission::class)->find($id);
            if (!$mission)
                throw $this->createNotFoundException('Mission Not Found');
        } else {
            $mission = new Mission();
        }
        $form = $this->createForm(MissionType::class, $mission);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($mission);
            $em->flush();
            $this->addFlash("success", "Votre mission a été enregistré avec succées");
            return $this->redirectToRoute("mission_list");
        }

        return $this->render('mission/form.html.twig', array(
            "mission" => $mission,
            "form" => $form->createView()
        ));
    }

    /**
     * @Route("/delete/{id}", name="mission_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $mission = $em->getRepository(Mission::class)->find($id);
        if($mission)
        {
            try{
                $em->remove($mission);
                $em->flush();
                $this->addFlash("success", "Votre mission a été supprimée avec succées");
            }
            catch (\Exception $exception)
            {
                $this->addFlash("danger", "Impossible de supprimer ce mission");
            }
        }
        return $this->redirectToRoute("mission_list");
    }
}
