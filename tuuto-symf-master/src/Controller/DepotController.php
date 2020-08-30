<?php

namespace App\Controller;

use App\Entity\Depot;
use App\Form\DepotType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Utils\Utils;

/**
 * @Route("/api/depot")
 */
class DepotController extends AbstractController
{
    /**
     * @Rest\Get(path="/", name="depot_index")
     * @Rest\View(StatusCode = 200)
     */
    public function index(): array
    {
        $depots = $this->getDoctrine()
            ->getRepository(Depot::class)
            ->findAll();

        return count($depots)?$depots:[];
    }

    /**
     * @Rest\Post(Path="/create", name="depot_new")
     * @Rest\View(StatusCode=200)
     */
    public function create(Request $request): Depot    {
        $depot = new Depot();
        $form = $this->createForm(DepotType::class, $depot);
        $form->submit(Utils::serializeRequestContent($request));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($depot);
        $entityManager->flush();

        return $depot;
    }

    /**
     * @Rest\Get(path="/{id}", name="depot_show",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function show(Depot $depot): Depot    {
        return $depot;
    }

    
    /**
     * @Rest\Put(path="/{id}/edit", name="depot_edit",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function edit(Request $request, Depot $depot): Depot    {
        $form = $this->createForm(DepotType::class, $depot);
        $form->submit(Utils::serializeRequestContent($request));

        $this->getDoctrine()->getManager()->flush();

        return $depot;
    }
    
    /**
     * @Rest\Put(path="/{id}/clone", name="depot_clone",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function cloner(Request $request, Depot $depot):  Depot {
        $em=$this->getDoctrine()->getManager();
        $depotNew=new Depot();
        $form = $this->createForm(DepotType::class, $depotNew);
        $form->submit(Utils::serializeRequestContent($request));
        $em->persist($depotNew);

        $em->flush();

        return $depotNew;
    }

    /**
     * @Rest\Delete("/{id}", name="depot_delete",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function delete(Depot $depot): Depot    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($depot);
        $entityManager->flush();

        return $depot;
    }
    
    /**
     * @Rest\Post("/delete-selection/", name="depot_selection_delete")
     * @Rest\View(StatusCode=200)
     */
    public function deleteMultiple(Request $request): array {
        $entityManager = $this->getDoctrine()->getManager();
        $depots = Utils::getObjectFromRequest($request);
        if (!count($depots)) {
            throw $this->createNotFoundException("Selectionner au minimum un élément à supprimer.");
        }
        foreach ($depots as $depot) {
            $depot = $entityManager->getRepository(Depot::class)->find($depot->id);
            $entityManager->remove($depot);
        }
        $entityManager->flush();

        return $depots;
    }
}
