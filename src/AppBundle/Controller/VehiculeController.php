<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Carburant;
use AppBundle\Entity\Entretient;
use AppBundle\Entity\PermisCirculation;
use AppBundle\Entity\Vehicule;
use AppBundle\Entity\VisiteTechnique;
use AppBundle\Entity\User;
use AppBundle\Entity\VehiculeOccupation;
use AppBundle\Form\CarburantType;
use AppBundle\Form\EntretientType;
use AppBundle\Form\PermisCirculationType;
use AppBundle\Form\VehiculeOccupationType;
use AppBundle\Form\VehiculeType;
use AppBundle\Form\VisiteTechniqueType;
use AppBundle\Form\UserType;
use Symfony\Component\Form\FormError;
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
            $dateFin = clone ($vehiculeOccupation->getDateOccupation());
            $dateFin->modify("-1 day");
            $em
                ->getRepository(VehiculeOccupation::class)
                ->updateChauffeursEncours($vehicule,$dateFin);
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
            $lastCarburant=$em->getRepository(Carburant::class)->findOneBy(array(
                'vehicule'=>$vehicule
            ),array(
                'kilometrage'=>"desc"
            ));
            if($lastCarburant and $lastCarburant->getKilometrage()>$carburant->getKilometrage())
                $form->get('kilometrage')->addError(new FormError('Kilometrage incorrecte'));
            else
            {
                $em->persist($carburant->setVehicule($vehicule));
                $em->flush();
                $this->addFlash("success", "Votre Bon a été enregistré avec succées");
                return $this->redirectToRoute("vehicule_form_carburants",array(
                    "id"=>$id
                ));
            }
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



    /**
     * @Route("/form/{id}/entretients/{id2}", name="vehicule_form_entretients")
     */
    public function indexEntretientAction($id,$id2=null,Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $vehicule = $em->getRepository(Vehicule::class)->find($id);
        if($id2)
            $entretient = $em->getRepository(Entretient::class)->find($id2);
        else
            $entretient = new Entretient();
        $form = $this->createForm(EntretientType::class,$entretient);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid())
        {
            $em->persist($entretient->setVehicule($vehicule));
            $em->flush();
            $this->addFlash("success", "Votre Entretient a été enregistré avec succées");
            return $this->redirectToRoute("vehicule_form_entretients",array(
                "id"=>$id
            ));
        }
        return $this->render(":vehicule:entretient.html.twig", array(
            "form" => $form->createView(),
            "vehicule"=>$vehicule
        ));
    }



    /**
     * @Route("/deleteEntretient/{id}", name="vehicule_entretient_delete")
     */
    public function deleteEntretientAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $entretient = $em->getRepository(entretient::class)->find($id);
        if($entretient)
        {
            try{
                /**
                 * @var $entretient Entretient
                 */
                $entretient
                    ->setPrix(0)
                    ->setFournisseur(" ")
                    ->setDesignation(" ") ;
                $em->persist($entretient);
                $em->flush();
                $this->addFlash("success", "Votre entretient a été supprimée avec succées");
            }
            catch (\Exception $exception)
            {
                $this->addFlash("danger", "Impossible de supprimer ce entretient");
            }
        }
        /**
         * @var $entretient Entretient
         */
        return $this->redirectToRoute("vehicule_form_entretients",array(
            "id"=>$entretient->getVehicule()->getId()
        ));
    }

    /**
     * @Route("/form/{id}/visiteTechniques/{id2}", name="vehicule_form_visiteTechniques")
     */
    public function indexVisiteTechniqueAction($id,$id2=null,Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $vehicule = $em->getRepository(Vehicule::class)->find($id);
        if($id2)
            $visiteTechnique = $em->getRepository(visiteTechnique::class)->find($id2);
        else
            $visiteTechnique = new visiteTechnique();
        $form = $this->createForm(visiteTechniqueType::class,$visiteTechnique);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid())
        {
            $em->persist($visiteTechnique->setVehicule($vehicule));
            $em->flush();
            $this->addFlash("success", "Votre Bon a été enregistré avec succées");
            return $this->redirectToRoute("vehicule_form_visiteTechniques",array(
                "id"=>$id
            ));
        }
        return $this->render(":vehicule:visiteTechnique.html.twig", array(
            "form" => $form->createView(),
            "vehicule"=>$vehicule
        ));
    }

    /**
     * @Route("/deletevisiteTechnique/{id}", name="vehicule_visiteTechnique_delete")
     */
    public function deleteVisiteTechniqueAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $visiteTechnique = $em->getRepository(visiteTechnique::class)->find($id);
        if($visiteTechnique)
        {
            try{
                $em->remove($visiteTechnique);
                $em->flush();
                $this->addFlash("success", "Votre bon a été supprimée avec succées");
            }
            catch (\Exception $exception)
            {
                $this->addFlash("danger", "Impossible de supprimer ce bon");
            }
        }
        /**
         * @var $visiteTechnique visiteTechnique
         */
        return $this->redirectToRoute("vehicule_form_visiteTechniques",array(
            "id"=>$visiteTechnique->getVehicule()->getId()
        ));
    }


    /**
     * @Route("/form/{id}/permisCirulations/{id2}", name="vehicule_form_permisCirulations")
     */
    public function indexPermisCirulationAction($id,$id2=null,Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $vehicule = $em->getRepository(Vehicule::class)->find($id);
        if($id2)
            $permisCirulation = $em->getRepository(PermisCirculation::class)->find($id2);
        else
            $permisCirulation = new PermisCirculation();
        $form = $this->createForm(PermisCirculationType::class,$permisCirulation);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid())
        {
            $em->persist($permisCirulation->setVehicule($vehicule));
            $em->flush();
            $this->addFlash("success", "Votre Bon a été enregistré avec succées");
            return $this->redirectToRoute("vehicule_form_permisCirulations",array(
                "id"=>$id
            ));
        }
        return $this->render(":vehicule:permisCirculation.html.twig", array(
            "form" => $form->createView(),
            "vehicule"=>$vehicule
        ));
    }

    /**
     * @Route("/deletepermisCirulation/{id}", name="vehicule_permisCirulation_delete")
     */
    public function deletePermisCirulationAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $permisCirulation = $em->getRepository(PermisCirculation::class)->find($id);
        if($permisCirulation)
        {
            try{
                $em->remove($permisCirulation);
                $em->flush();
                $this->addFlash("success", "Votre permit de circulation a été supprimée avec succées");
            }
            catch (\Exception $exception)
            {
                $this->addFlash("danger", "Impossible de supprimer ce permit de circulation");
            }
        }
        /**
         * @var $permisCirulation PermisCirculation
         */
        return $this->redirectToRoute("vehicule_form_permisCirulations",array(
            "id"=>$permisCirulation->getVehicule()->getId()
        ));
    }
}
