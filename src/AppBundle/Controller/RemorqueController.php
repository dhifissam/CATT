<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Entretient;
use AppBundle\Entity\PermisCirculation;
use AppBundle\Entity\Remorque;
use AppBundle\Entity\VisiteTechnique;
use AppBundle\Entity\User;
use AppBundle\Form\EntretientType;
use AppBundle\Form\PermisCirculationType;
use AppBundle\Form\RemorqueType;
use AppBundle\Form\VisiteTechniqueType;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/remorque")
 */
class RemorqueController extends Controller
{

    /**
     * @Route("/", name="remorque_list")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $remorques = $em->getRepository(Remorque::class)->findAll();
        return $this->render(":remorque:list.html.twig", array(
            "remorques" => $remorques
        ));
    }


    /**
     * @Route("/form/{id}", name="remorque_form")
     */
    public function formAction(Request $request, $id = null)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        if ($id) {
            $remorque = $em->getRepository(Remorque::class)->find($id);
            if (!$remorque)
                throw $this->createNotFoundException('Remorque Not Found');
        } else {
            $remorque = new Remorque();
        }
        //dump($remorque->getRemorque()->count());
        $form = $this->createForm(RemorqueType::class, $remorque);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($remorque);
            $em->flush();
            $this->addFlash("success", "Votre remorque a été enregistré avec succées");
            return $this->redirectToRoute("remorque_list");
        }

        return $this->render('remorque/form.html.twig', array(
            "remorque" => $remorque,
            "form" => $form->createView()
        ));
    }

    /**
     * @Route("/delete/{id}", name="remorque_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $remorque = $em->getRepository(Remorque::class)->find($id);
        if($remorque)
        {
            try{
                $em->remove($remorque);
                $em->flush();
                $this->addFlash("success", "Votre remorque a été supprimée avec succées");
            }
            catch (\Exception $exception)
            {
                $this->addFlash("danger", "Impossible de supprimer cette remorque");
            }
        }
        return $this->redirectToRoute("remorque_list");
    }


    /**
     * @Route("/form/{id}/entretients/{id2}", name="remorque_form_entretients")
     */
    public function indexEntretientAction($id,$id2=null,Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $remorque = $em->getRepository(Remorque::class)->find($id);
        if($id2)
            $entretient = $em->getRepository(Entretient::class)->find($id2);
        else
            $entretient = new Entretient();
        $form = $this->createForm(EntretientType::class,$entretient);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid())
        {
            $em->persist($entretient->setRemorque($remorque));
            $em->flush();
            $this->addFlash("success", "Votre Entretient a été enregistré avec succées");
            return $this->redirectToRoute("remorque_form_entretients",array(
                "id"=>$id
            ));
        }
        return $this->render(":remorque:entretient.html.twig", array(
            "form" => $form->createView(),
            "remorque"=>$remorque
        ));
    }



    /**
     * @Route("/deleteEntretient/{id}", name="remorque_entretient_delete")
     */
    public function deleteEntretientAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $entretient = $em->getRepository(entretient::class)->find($id);
        if($entretient)
        {
            try{
                $em->remove($entretient);
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
        return $this->redirectToRoute("remorque_form_entretients",array(
            "id"=>$entretient->getRemorque()->getId()
        ));
    }

    /**
     * @Route("/form/{id}/visiteTechniques/{id2}", name="remorque_form_visiteTechniques")
     */
    public function indexVisiteTechniqueAction($id,$id2=null,Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $remorque = $em->getRepository(Remorque::class)->find($id);
        if($id2)
            $visiteTechnique = $em->getRepository(visiteTechnique::class)->find($id2);
        else
            $visiteTechnique = new visiteTechnique();
        $form = $this->createForm(visiteTechniqueType::class,$visiteTechnique);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid())
        {
            $em->persist($visiteTechnique->setRemorque($remorque));
            $em->flush();
            $this->addFlash("success", "Votre visite technique a été enregistré avec succées");
            return $this->redirectToRoute("remorque_form_visiteTechniques",array(
                "id"=>$id
            ));
        }
        return $this->render(":remorque:visiteTechnique.html.twig", array(
            "form" => $form->createView(),
            "remorque"=>$remorque
        ));
    }



    /**
     * @Route("/deletevisiteTechnique/{id}", name="remorque_visiteTechnique_delete")
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
                $this->addFlash("success", "Votre visite technique a été supprimée avec succées");
            }
            catch (\Exception $exception)
            {
                $this->addFlash("danger", "Impossible de supprimer cette visite technique");
            }
        }
        /**
         * @var $visiteTechnique visiteTechnique
         */
        return $this->redirectToRoute("remorque_form_visiteTechniques",array(
            "id"=>$visiteTechnique->getRemorque()->getId()
        ));
    }


    /**
     * @Route("/form/{id}/permisCirculations/{id2}", name="remorque_form_permisCirculations")
     */
    public function indexPermisCirculationAction($id,$id2=null,Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $remorque = $em->getRepository(Remorque::class)->find($id);
        if($id2)
            $permisCirculation = $em->getRepository(PermisCirculation::class)->find($id2);
        else
            $permisCirculation = new PermisCirculation();
        $form = $this->createForm(PermisCirculationType::class,$permisCirculation);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid())
        {
            $em->persist($permisCirculation->setRemorque($remorque));
            $em->flush();
            $this->addFlash("success", "Votre permis de circulation a été enregistré avec succées");
            return $this->redirectToRoute("remorque_form_permisCirculations",array(
                "id"=>$id
            ));
        }
        return $this->render(":remorque:permisCirculation.html.twig", array(
            "form" => $form->createView(),
            "remorque"=>$remorque
        ));
    }



    /**
     * @Route("/deletepermisCirculation/{id}", name="remorque_permisCirculation_delete")
     */
    public function deletePermisCirculationAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $permisCirculation = $em->getRepository(permisCirculation::class)->find($id);
        if($permisCirculation)
        {
            try{
                $em->remove($permisCirculation);
                $em->flush();
                $this->addFlash("success", "Votre permis de circulation a été supprimée avec succées");
            }
            catch (\Exception $exception)
            {
                $this->addFlash("danger", "Impossible de supprimer ce permis de circulation");
            }
        }
        /**
         * @var $permisCirculation permisCirculation
         */
        return $this->redirectToRoute("remorque_form_permisCirculations",array(
            "id"=>$permisCirculation->getRemorque()->getId()
        ));
    }



}
