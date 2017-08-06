<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Carburant;
use AppBundle\Entity\Vehicule;
use AppBundle\Entity\User;
use AppBundle\Entity\VehiculeOccupation;
use AppBundle\Form\CarburantType;
use AppBundle\Form\VehiculeOccupationType;
use AppBundle\Form\VehiculeType;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/vehicule")
 */
class VehiculeController extends Controller
{

    /**
     * @Route("/", name="vehicule_list")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $vehicules = $em->getRepository(Vehicule::class)->findAll();
        return $this->render(":vehicule:list.html.twig", array(
            "vehicules" => $vehicules
        ));
    }

    /**
     * @Route("/form/{id}", name="vehicule_form")
     */
    public function formAction(Request $request, $id = null)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        if ($id) {
            $vehicule = $em->getRepository(Vehicule::class)->find($id);
            if (!$vehicule)
                throw $this->createNotFoundException('Vehicule Not Found');
        } else {
            $vehicule = new Vehicule();
        }
        //dump($vehicule->getVehiculeOccupations()->count());
        $form = $this->createForm(VehiculeType::class, $vehicule);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($vehicule);
            $em->flush();
            $this->addFlash("success", "Votre vehicule a été enregistré avec succées");
            return $this->redirectToRoute("vehicule_list");
        }

        return $this->render('vehicule/form.html.twig', array(
            "vehicule" => $vehicule,
            "form" => $form->createView()
        ));
    }

    /**
     * @Route("/delete/{id}", name="vehicule_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $vehicule = $em->getRepository(Vehicule::class)->find($id);
        if($vehicule)
        {
            try{
                $em->remove($vehicule);
                $em->flush();
                $this->addFlash("success", "Votre vehicule a été supprimée avec succées");
            }
            catch (\Exception $exception)
            {
                $this->addFlash("danger", "Impossible de supprimer cette vehicule");
            }
        }
        return $this->redirectToRoute("vehicule_list");
    }

    /**
     * @Route("/form/{id}/chauffeurs/{id2}", name="vehicule_form_chauffeurs")
     */
    public function indexChauffeursAction($id,$id2=null,Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $vehicule = $em->getRepository(Vehicule::class)->find($id);
        if($id2)
            $vehiculeOccupation = $em->getRepository(VehiculeOccupation::class)->find($id2);
        else
            $vehiculeOccupation = new VehiculeOccupation();
        $form = $this->createForm(VehiculeOccupationType::class,$vehiculeOccupation);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid())
        {
            $em->persist($vehiculeOccupation->setVehicule($vehicule));
            $em->flush();
            $this->addFlash("success", "Votre chauffeur a été enregistré avec succées");
            return $this->redirectToRoute("vehicule_form_chauffeurs",array(
                "id"=>$id
            ));
        }
        return $this->render(":vehicule:chauffeurs.html.twig", array(
            "form" => $form->createView(),
            "vehicule"=>$vehicule
        ));
    }


    /**
     * @Route("/deleteChauffeur/{id}", name="vehicule_chauffeur_delete")
     */
    public function deleteChauffeurAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $vehiculeOccupation = $em->getRepository(VehiculeOccupation::class)->find($id);
        if($vehiculeOccupation)
        {
            try{
                $em->remove($vehiculeOccupation);
                $em->flush();
                $this->addFlash("success", "Votre chauffeur a été supprimée avec succées");
            }
            catch (\Exception $exception)
            {
                $this->addFlash("danger", "Impossible de supprimer ce chauffeur");
            }
        }
        /**
         * @var $vehiculeOccupation VehiculeOccupation
         */
        return $this->redirectToRoute("vehicule_form_chauffeurs",array(
            "id"=>$vehiculeOccupation->getVehicule()->getId()
        ));
    }


    /**
     * @Route("/form/{id}/carburants/{id2}", name="vehicule_form_carburants")
     */
    public function indexCarburantAction($id,$id2=null,Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $vehicule = $em->getRepository(Vehicule::class)->find($id);
        if($id2)
            $carburant = $em->getRepository(Carburant::class)->find($id2);
        else
            $carburant = new Carburant();
        $form = $this->createForm(CarburantType::class,$carburant);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid())
        {
            $em->persist($carburant->setVehicule($vehicule));
            $em->flush();
            $this->addFlash("success", "Votre Bon a été enregistré avec succées");
            return $this->redirectToRoute("vehicule_form_carburants",array(
                "id"=>$id
            ));
        }
        return $this->render(":vehicule:carburant.html.twig", array(
            "form" => $form->createView(),
            "vehicule"=>$vehicule
        ));
    }



    /**
     * @Route("/deleteCarburant/{id}", name="vehicule_carburant_delete")
     */
    public function deleteCarburantAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $carburant = $em->getRepository(carburant::class)->find($id);
        if($carburant)
        {
            try{
                $em->remove($carburant);
                $em->flush();
                $this->addFlash("success", "Votre bon a été supprimée avec succées");
            }
            catch (\Exception $exception)
            {
                $this->addFlash("danger", "Impossible de supprimer ce bon");
            }
        }
        /**
         * @var $carburant Carburant
         */
        return $this->redirectToRoute("vehicule_form_carburants",array(
            "id"=>$carburant->getVehicule()->getId()
        ));
    }



}
