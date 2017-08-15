<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TypeEntretient;
use AppBundle\Form\TypeEntretientType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/typeEntretient")
 */
class TypeEntretientController extends Controller
{

    /**
     * @Route("/", name="typeEntretient_list")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $typeEntretients = $em->getRepository(TypeEntretient::class)->findAll();
        return $this->render(":typeEntretient:list.html.twig", array(
            "typeEntretients" => $typeEntretients
        ));
    }

    /**
     * @Route("/form/{id}", name="typeEntretient_form")
     */
    public function formAction(Request $request, $id = null)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        if ($id) {
            $typeEntretient = $em->getRepository(TypeEntretient::class)->find($id);
            if (!$typeEntretient)
                throw $this->createNotFoundException('TypeEntretient Not Found');
        } else {
            $typeEntretient = new TypeEntretient();
        }
        $form = $this->createForm(TypeEntretientType::class, $typeEntretient);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($typeEntretient);
            $em->flush();
            $this->addFlash("success", "Votre typeEntretient a été enregistré avec succées");
            return $this->redirectToRoute("typeEntretient_list");
        }

        return $this->render('typeEntretient/form.html.twig', array(
            "typeEntretient" => $typeEntretient,
            "form" => $form->createView()
        ));
    }

    /**
     * @Route("/delete/{id}", name="typeEntretient_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $typeEntretient = $em->getRepository(TypeEntretient::class)->find($id);
        if($typeEntretient)
        {
            try{
                $em->remove($typeEntretient);
                $em->flush();
                $this->addFlash("success", "Votre typeEntretient a été supprimée avec succées");
            }
            catch (\Exception $exception)
            {
                $this->addFlash("danger", "Impossible de supprimer ce typeEntretient");
            }
        }
        return $this->redirectToRoute("typeEntretient_list");
    }
}
