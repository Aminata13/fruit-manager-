<?php

namespace App\Controller;

use App\Entity\Camion;
use App\Form\CamionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Utils\Utils;

/**
 * @Route("/api/camion")
 */
class CamionController extends AbstractController
{
    /**
     * @Rest\Get(path="/", name="camion_index")
     * @Rest\View(StatusCode = 200)
     */
    public function index(): array
    {
        $camions = $this->getDoctrine()
            ->getRepository(Camion::class)
            ->findAll();

        return count($camions)?$camions:[];
    }

    /**
     * @Rest\Post(Path="/create", name="camion_new")
     * @Rest\View(StatusCode=200)
     */
    public function create(Request $request): Camion    {
        $camion = new Camion();
        $form = $this->createForm(CamionType::class, $camion);
        $form->submit(Utils::serializeRequestContent($request));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($camion);
        $entityManager->flush();

        return $camion;
    }

    /**
     * @Rest\Get(path="/{id}", name="camion_show",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function show(Camion $camion): Camion    {
        return $camion;
    }

    
    /**
     * @Rest\Put(path="/{id}/edit", name="camion_edit",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function edit(Request $request, Camion $camion): Camion    {
        $form = $this->createForm(CamionType::class, $camion);
        $form->submit(Utils::serializeRequestContent($request));

        $this->getDoctrine()->getManager()->flush();

        return $camion;
    }
    
    /**
     * @Rest\Put(path="/{id}/clone", name="camion_clone",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function cloner(Request $request, Camion $camion):  Camion {
        $em=$this->getDoctrine()->getManager();
        $camionNew=new Camion();
        $form = $this->createForm(CamionType::class, $camionNew);
        $form->submit(Utils::serializeRequestContent($request));
        $em->persist($camionNew);

        $em->flush();

        return $camionNew;
    }

    /**
     * @Rest\Delete("/{id}", name="camion_delete",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function delete(Camion $camion): Camion    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($camion);
        $entityManager->flush();

        return $camion;
    }
    
    /**
     * @Rest\Post("/delete-selection/", name="camion_selection_delete")
     * @Rest\View(StatusCode=200)
     */
    public function deleteMultiple(Request $request): array {
        $entityManager = $this->getDoctrine()->getManager();
        $camions = Utils::getObjectFromRequest($request);
        if (!count($camions)) {
            throw $this->createNotFoundException("Selectionner au minimum un élément à supprimer.");
        }
        foreach ($camions as $camion) {
            $camion = $entityManager->getRepository(Camion::class)->find($camion->id);
            $entityManager->remove($camion);
        }
        $entityManager->flush();

        return $camions;
    }
}
