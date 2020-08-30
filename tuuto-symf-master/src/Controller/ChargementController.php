<?php

namespace App\Controller;

use App\Entity\Chargement;
use App\Form\ChargementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Utils\Utils;

/**
 * @Route("/api/chargement")
 */
class ChargementController extends AbstractController
{
    /**
     * @Rest\Get(path="/", name="chargement_index")
     * @Rest\View(StatusCode = 200)
     */
    public function index(): array
    {
        $chargements = $this->getDoctrine()
            ->getRepository(Chargement::class)
            ->findAll();

        return count($chargements)?$chargements:[];
    }

    /**
     * @Rest\Post(Path="/create", name="chargement_new")
     * @Rest\View(StatusCode=200)
     */
    public function create(Request $request): Chargement    {
        $chargement = new Chargement();
        $form = $this->createForm(ChargementType::class, $chargement);
        $form->submit(Utils::serializeRequestContent($request));
        $entityManager = $this->getDoctrine()->getManager();
        $chargement->setDate(new \DateTime());
        $entityManager->persist($chargement);
        $entityManager->flush();

        return $chargement;
    }

    /**
     * @Rest\Get(path="/{id}", name="chargement_show",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function show(Chargement $chargement): Chargement    {
        return $chargement;
    }

    
    /**
     * @Rest\Put(path="/{id}/edit", name="chargement_edit",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function edit(Request $request, Chargement $chargement): Chargement    {
        $form = $this->createForm(ChargementType::class, $chargement);
        $form->submit(Utils::serializeRequestContent($request));

        $this->getDoctrine()->getManager()->flush();

        return $chargement;
    }
    
    /**
     * @Rest\Put(path="/{id}/clone", name="chargement_clone",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function cloner(Request $request, Chargement $chargement):  Chargement {
        $em=$this->getDoctrine()->getManager();
        $chargementNew=new Chargement();
        $form = $this->createForm(ChargementType::class, $chargementNew);
        $form->submit(Utils::serializeRequestContent($request));
        $em->persist($chargementNew);

        $em->flush();

        return $chargementNew;
    }

    /**
     * @Rest\Delete("/{id}", name="chargement_delete",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function delete(Chargement $chargement): Chargement    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($chargement);
        $entityManager->flush();

        return $chargement;
    }
    
    /**
     * @Rest\Post("/delete-selection/", name="chargement_selection_delete")
     * @Rest\View(StatusCode=200)
     */
    public function deleteMultiple(Request $request): array {
        $entityManager = $this->getDoctrine()->getManager();
        $chargements = Utils::getObjectFromRequest($request);
        if (!count($chargements)) {
            throw $this->createNotFoundException("Selectionner au minimum un élément à supprimer.");
        }
        foreach ($chargements as $chargement) {
            $chargement = $entityManager->getRepository(Chargement::class)->find($chargement->id);
            $entityManager->remove($chargement);
        }
        $entityManager->flush();

        return $chargements;
    }
}
