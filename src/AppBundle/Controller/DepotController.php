<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Depot;
use AppBundle\Form\DepotType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/depot")
 */
class DepotController extends Controller
{

    /**
     * @Route("/", name="depot_list")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $depots = $em->getRepository(Depot::class)->findAll();
        return $this->render(":depot:list.html.twig", array(
            "depots" => $depots
        ));
    }

    /**
     * @Route("/form/{id}", name="depot_form")
     */
    public function formAction(Request $request, $id = null)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        if ($id) {
            $depot = $em->getRepository(Depot::class)->find($id);
            if (!$depot)
                throw $this->createNotFoundException('Depot Not Found');
        } else {
            $depot = new Depot();
        }
        $form = $this->createForm(DepotType::class, $depot);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($depot);
            $em->flush();
            $this->addFlash("success", "Votre depot a été enregistré avec succées");
            return $this->redirectToRoute("depot_list");
        }

        return $this->render('depot/form.html.twig', array(
            "depot" => $depot,
            "form" => $form->createView()
        ));
    }

    /**
     * @Route("/delete/{id}", name="depot_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $depot = $em->getRepository(Depot::class)->find($id);
        if($depot)
        {
            try{
                $em->remove($depot);
                $em->flush();
                $this->addFlash("success", "Votre depot a été supprimée avec succées");
            }
            catch (\Exception $exception)
            {
                $this->addFlash("danger", "Impossible de supprimer ce depot");
            }
        }
        return $this->redirectToRoute("depot_list");
    }
}
