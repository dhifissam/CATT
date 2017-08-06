<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/user")
 */
class UserController extends Controller
{

    /**
     * @Route("/", name="user_list")
     */
    public function indexAction(Request $request)
    {
        if ($request->isXmlHttpRequest())
        {
            $em = $this->get('doctrine.orm.entity_manager');
            $dataRequest = $this->get('datatable.service')->getFilter();
            extract($dataRequest);
            $items = $em->getRepository(User::class)->dataTable($filters, $start, $length, true, $columNameOrder, $dirOrder);
            $output = array(
                'data'            => array(),
                'recordsFiltered' => count($em->getRepository(User::class)->dataTable($filters)),
                'recordsTotal'    => count($em->getRepository(User::class)->dataTable())
            );
            foreach ($items as $item)
            {
                $output['data'][] = [
                    'id'       => $item->getId(),
                    'username' => $item->getUsername(),
                    'email'    => $item->getEmail(),
                    'fullName' => $item->getFullName(),
                    'roles'    => $this->renderView(":user:actions.html.twig", array("viewType" => "roles", 'item' => $item)),
                    'status'    => $this->renderView(":user:actions.html.twig", array("viewType" => "status", 'item' => $item)),
                    'actions'  => $this->renderView(":user:actions.html.twig", array("viewType" => "actions", 'item' => $item))
                ];
            }
            return new JsonResponse($output);
        }
        return $this->render(":user:list.html.twig");
    }

    /**
     * @Route("/form/{id}", name="user_form")
     */
    public function formAction(Request $request, $id = null)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        if ($id)
        {
            $user = $em->getRepository(User::class)->find($id);
            $form = $this->createForm(UserType::class, $user, array('validation_groups' => array('Profile')))->remove("plainPassword");
            if (!$user)
                throw $this->createNotFoundException('User Not Found');
        } else
        {
            $user = new User();
            $form = $this->createForm(UserType::class, $user, array('validation_groups' => array('Registration')));
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($user);
            $em->flush();
            $this->addFlash("success", "Votre utilisateur a été enregistré avec succées");
            return $this->redirectToRoute("user_list");
        }

        return $this->render('user/form.html.twig', array(
            "user" => $user,
            "form" => $form->createView()
        ));
    }

    /**
     * @Route("/delete/{id}", name="user_delete")
     */
    public function deleteAction(User $user)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        try
        {
            if($this->getUser()->getId() == $user->getId())
                return new JsonResponse(false);

            $em->remove($user);
            $em->flush();
            return new JsonResponse(true);
        } catch (\Exception $ex)
        {
            return new JsonResponse(false);
        }
    }
}
