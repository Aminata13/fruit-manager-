<?php

namespace App\Controller;

use App\Entity\Fruit;
use App\Entity\Depot;
use App\Form\FruitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Utils\Utils;

/**
 * @Route("/api/fruit")
 */
class FruitController extends AbstractController
{
    /**
     * @Rest\Get(path="/", name="fruit_index")
     * @Rest\View(StatusCode = 200)
     */
    public function index(): array
    {
        $fruits = $this->getDoctrine()
            ->getRepository(Fruit::class)
            ->findAll();

        return count($fruits)?$fruits:[];
    }
    
    /**
     * @Rest\Get(path="/depot/{id}", name="depot_show_fruits",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function showFruitsByDepot(Depot $depot): array
    {
        $fruits = $this->getDoctrine()
            ->getRepository(Fruit::class)
            ->findByDepot($depot);

        return count($fruits)?$fruits:[];
    }

    /**
     * @Rest\Post(Path="/create", name="fruit_new")
     * @Rest\View(StatusCode=200)
     */
    public function create(Request $request): Fruit    {
        $fruit = new Fruit();
        $form = $this->createForm(FruitType::class, $fruit);
        $form->submit(Utils::serializeRequestContent($request));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($fruit);
        $entityManager->flush();

        return $fruit;
    }

    /**
     * @Rest\Get(path="/{id}", name="fruit_show",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function show(Fruit $fruit): Fruit    {
        return $fruit;
    }

    
    /**
     * @Rest\Put(path="/{id}/edit", name="fruit_edit",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function edit(Request $request, Fruit $fruit): Fruit    {
        $form = $this->createForm(FruitType::class, $fruit);
        $form->submit(Utils::serializeRequestContent($request));

        $this->getDoctrine()->getManager()->flush();

        return $fruit;
    }
    
    /**
     * @Rest\Put(path="/{id}/clone", name="fruit_clone",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function cloner(Request $request, Fruit $fruit):  Fruit {
        $em=$this->getDoctrine()->getManager();
        $fruitNew=new Fruit();
        $form = $this->createForm(FruitType::class, $fruitNew);
        $form->submit(Utils::serializeRequestContent($request));
        $em->persist($fruitNew);

        $em->flush();

        return $fruitNew;
    }

    /**
     * @Rest\Delete("/{id}", name="fruit_delete",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function delete(Fruit $fruit): Fruit    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($fruit);
        $entityManager->flush();

        return $fruit;
    }
    
    /**
     * @Rest\Post("/delete-selection/", name="fruit_selection_delete")
     * @Rest\View(StatusCode=200)
     */
    public function deleteMultiple(Request $request): array {
        $entityManager = $this->getDoctrine()->getManager();
        $fruits = Utils::getObjectFromRequest($request);
        if (!count($fruits)) {
            throw $this->createNotFoundException("Selectionner au minimum un élément à supprimer.");
        }
        foreach ($fruits as $fruit) {
            $fruit = $entityManager->getRepository(Fruit::class)->find($fruit->id);
            $entityManager->remove($fruit);
        }
        $entityManager->flush();

        return $fruits;
    }
}
