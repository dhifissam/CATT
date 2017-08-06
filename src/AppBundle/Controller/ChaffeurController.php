<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Chauffeur;
use AppBundle\Entity\Salaire;
use AppBundle\Entity\User;
use AppBundle\Form\ChauffeurType;
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
                $em->remove($salaire);
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







}
