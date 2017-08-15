<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use AppBundle\Form\ClientType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/client")
 */
class ClientController extends Controller
{

    /**
     * @Route("/", name="client_list")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $clients = $em->getRepository(Client::class)->findAll();
        return $this->render(":client:list.html.twig", array(
            "clients" => $clients
        ));
    }

    /**
     * @Route("/form/{id}", name="client_form")
     */
    public function formAction(Request $request, $id = null)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        if ($id) {
            $client = $em->getRepository(Client::class)->find($id);
            if (!$client)
                throw $this->createNotFoundException('Client Not Found');
        } else {
            $client = new Client();
        }
        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($client);
            $em->flush();
            $this->addFlash("success", "Votre client a été enregistré avec succées");
            return $this->redirectToRoute("client_list");
        }

        return $this->render('client/form.html.twig', array(
            "client" => $client,
            "form" => $form->createView()
        ));
    }

    /**
     * @Route("/delete/{id}", name="client_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $client = $em->getRepository(Client::class)->find($id);
        if($client)
        {
            try{
                $em->remove($client);
                $em->flush();
                $this->addFlash("success", "Votre client a été supprimée avec succées");
            }
            catch (\Exception $exception)
            {
                $this->addFlash("danger", "Impossible de supprimer ce client");
            }
        }
        return $this->redirectToRoute("client_list");
    }
}
