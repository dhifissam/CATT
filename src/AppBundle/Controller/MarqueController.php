<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Marque;
use AppBundle\Form\MarqueType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/marque")
 */
class MarqueController extends Controller
{

    /**
     * @Route("/", name="marque_list")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $marques = $em->getRepository(Marque::class)->findAll();
        return $this->render(":marque:list.html.twig", array(
            "marques" => $marques
        ));
    }

    /**
     * @Route("/form/{id}", name="marque_form")
     */
    public function formAction(Request $request, $id = null)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        if ($id) {
            $marque = $em->getRepository(Marque::class)->find($id);
            if (!$marque)
                throw $this->createNotFoundException('Marque Not Found');
        } else {
            $marque = new Marque();
        }
        $form = $this->createForm(MarqueType::class, $marque);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($marque);
            $em->flush();
            $this->addFlash("success", "Votre marque a été enregistré avec succées");
            return $this->redirectToRoute("marque_list");
        }

        return $this->render('marque/form.html.twig', array(
            "marque" => $marque,
            "form" => $form->createView()
        ));
    }

    /**
     * @Route("/delete/{id}", name="marque_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $marque = $em->getRepository(Marque::class)->find($id);
        if($marque)
        {
            try{
                $em->remove($marque);
                $em->flush();
                $this->addFlash("success", "Votre marque a été supprimée avec succées");
            }
            catch (\Exception $exception)
            {
                $this->addFlash("danger", "Impossible de supprimer cette marque");
            }
        }
        return $this->redirectToRoute("marque_list");
    }
}
