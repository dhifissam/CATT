<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Chauffeur;
use AppBundle\Entity\Pointage;
use AppBundle\Entity\Salaire;
use AppBundle\Entity\User;
use AppBundle\Form\ChauffeurType;
use AppBundle\Form\PointageType;
use AppBundle\Form\SalaireType;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/chauffeur")
 */
class ChaffeurController extends Controller
{

    /**
     * @Route("/", name="chauffeur_list")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $chauffeurs = $em->getRepository(Chauffeur::class)->findAll();
        return $this->render(":chauffeur:list.html.twig", array(
            "chaffeurs" => $chauffeurs
        ));
    }

    /**
     * @Route("/form/{id}", name="chauffeur_form")
     */
    public function formAction(Request $request, $id = null)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        if ($id) {
            $chauffeur = $em->getRepository(Chauffeur::class)->find($id);
            if (!$chauffeur)
                throw $this->createNotFoundException('Chauffeur Not Found');
        } else {
            $chauffeur = new Chauffeur();
        }
        $form = $this->createForm(ChauffeurType::class, $chauffeur);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($chauffeur);
            $em->flush();
            $this->addFlash("success", "Votre chaffeur a été enregistré avec succées");
            return $this->redirectToRoute("chauffeur_list");
        }

        return $this->render('chauffeur/form.html.twig', array(
            "chauffeur" => $chauffeur,
            "form" => $form->createView()
        ));
    }

    /**
     * @Route("/delete/{id}", name="chauffeur_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $chauffeur = $em->getRepository(Chauffeur::class)->find($id);
        if($chauffeur)
        {
            try{
                $em->remove($chauffeur);
                $em->flush();
                $this->addFlash("success", "Votre chaffeur a été supprimée avec succées");
            }
            catch (\Exception $exception)
            {
                $this->addFlash("danger", "Impossible de supprimer ce chauffeur");
            }
        }
        return $this->redirectToRoute("chauffeur_list");
    }

    /**
     * @Route("/form/{id}/salaires/{id2}", name="chauffeur_form_salaires")
     */
    public function salairesAction($id,$id2=null,Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $chauffeur = $em->getRepository(Chauffeur::class)->find($id);
        if($id2)
            $salaire = $em->getRepository(Salaire::class)->find($id2);
        else
            $salaire = new Salaire();
        $form = $this->createForm(SalaireType::class,$salaire);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid())
        {
            if(!$id2)
            {
                $verif =$em->getRepository(Salaire::class)->findOneBy(array(
                    "chauffeur"=>$chauffeur,
                    "mois"=>$salaire->getMois(),
                    "annee"=>$salaire->getAnnee()
                ));
                if($verif)
                {
                    $this->addFlash("info", "Salaire déjà existant");
                    return $this->render(":chauffeur:salaires.html.twig", array(
                        "form" => $form->createView(),
                        "chauffeur"=>$chauffeur,
                        "salaire"=>$salaire,
                        "salaires"=>$em->getRepository(Salaire::class)->findBy(array(
                            "chauffeur"=>$chauffeur
                        ))
                    ));
                }
            }
            $em->persist($salaire->setChauffeur($chauffeur));
            $em->flush();
            $this->addFlash("success", "Votre salaire a été enregistré avec succées");
            return $this->redirectToRoute("chauffeur_form_salaires",array(
                "id"=>$id
            ));
        }
        return $this->render(":chauffeur:salaires.html.twig", array(
            "form" => $form->createView(),
            "chauffeur"=>$chauffeur,
            "salaire"=>$salaire,
            "salaires"=>$em->getRepository(Salaire::class)->findBy(array(
                "chauffeur"=>$chauffeur
            ))
        ));
    }

    /**
     * @Route("/deleteSalaire/{id}", name="salaire_delete")
     */
    public function deleteSalaireAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $salaire = $em->getRepository(salaire::class)->find($id);
        if($salaire)
        {
            try{
                /**
                 * @var $salaire Salaire
                 */
                $salaire
                    ->setMontant(0)
                    ->setAvance(0)
                    ->setHeureSupp50(0)
                    ->setHeureSupp75(0)
                    ->setMonatantDinee(0)
                    ->setMontantDejeuner(0)
                    ->setMontantNuitee(0)
                    ->setNbrJourTravailer(0);
                $em->persist($salaire);
                //$em->remove($salaire);
                $em->flush();
                $this->addFlash("success", "Votre salaire a été supprimée avec succées");
            }
            catch (\Exception $exception)
            {
                $this->addFlash("danger", "Impossible de supprimer ce salaire");
            }
        }
        /**
         * @var $salaire Salaire
         */
        return $this->redirectToRoute("chauffeur_form_salaires",array(
            "id"=>$salaire->getChauffeur()->getId()
        ));
    }


    /**
     * @Route("/form/{id}/pointages/{id2}", name="chauffeur_form_pointages")
     */
    public function pointagesAction($id,$id2=null,Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $chauffeur = $em->getRepository(Chauffeur::class)->find($id);
        if($id2)
            $pointage = $em->getRepository(Pointage::class)->find($id2);
        else
        {
            $pointage = new Pointage();
            $pointage->setChauffeur($chauffeur);
        }
        $form = $this->createForm(PointageType::class,$pointage);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid())
        {
            /*if(!$id2)
            {
                    $this->addFlash("info", "Pointage déjà existant");
                    return $this->render(":chauffeur:pointages.html.twig", array(
                        "form" => $form->createView(),
                        "chauffeur"=>$chauffeur,
                        "pointage"=>$pointage,
                        "pointages"=>$em->getRepository(Pointage::class)->findBy(array(
                            "chauffeur"=>$chauffeur
                        ))
                    ));
            }*/
            $em->persist($pointage->setChauffeur($chauffeur));
            $em->flush();
            $this->addFlash("success", "Votre pointage a été enregistré avec succées");
            return $this->redirectToRoute("chauffeur_form_pointages",array(
                "id"=>$id
            ));
        }
        return $this->render(":chauffeur:pointages.html.twig", array(
            "form" => $form->createView(),
            "chauffeur"=>$chauffeur,
            "pointage"=>$pointage,
            "pointages"=>$em->getRepository(Pointage::class)->findBy(array(
                "chauffeur"=>$chauffeur
            ))
        ));
    }

    /**
     * @Route("/deletePointage/{id}", name="pointage_delete")
     */
    public function deletePointageAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $pointage = $em->getRepository(Pointage::class)->find($id);
        if($pointage)
        {
            try{
                $em->remove($pointage);
                $em->flush();
                $this->addFlash("success", "Votre pointage a été supprimée avec succées");
            }
            catch (\Exception $exception)
            {
                $this->addFlash("danger", "Impossible de supprimer ce pointage");
            }
        }
        /**
         * @var $pointage Pointage
         */
        return $this->redirectToRoute("chauffeur_form_pointages",array(
            "id"=>$pointage->getChauffeur()->getId()
        ));
    }




}
