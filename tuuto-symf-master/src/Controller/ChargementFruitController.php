<?php

namespace App\Controller;

use App\Entity\ChargementFruit;
use App\Entity\Chargement;
use App\Entity\Fruit;
use App\Form\FruitType;
use App\Controller\FruitController;
use App\Form\ChargementFruitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Utils\Utils;

/**
 * @Route("/api/chargement-fruit")
 */
class ChargementFruitController extends AbstractController
{
    /**
     * @Rest\Get(path="/", name="chargement_fruit_index")
     * @Rest\View(StatusCode = 200)
     */
    public function index(): array
    {
        $chargementFruits = $this->getDoctrine()
            ->getRepository(ChargementFruit::class)
            ->findAll();

        return count($chargementFruits)?$chargementFruits:[];
    }

    /**
     * @Rest\Post(Path="/create", name="chargement_fruit_new")
     * @Rest\View(StatusCode=200)
     */
    public function create(Request $request): ChargementFruit    {
        $chargementFruit = new ChargementFruit();
        $form = $this->createForm(ChargementFruitType::class, $chargementFruit);
        $form->submit(Utils::serializeRequestContent($request));
        
        $quantiteDisponible = $chargementFruit->getFruit()->getQuantiteStock();
        $quantite = $chargementFruit->getQuantite();
        $stockRestant = $quantiteDisponible - $quantite;
        
        if($quantite <= $quantiteDisponible){
            
            $entityManager = $this->getDoctrine()->getManager();
            $fruit = $chargementFruit->getFruit()->setQuantiteStock($stockRestant);
            $entityManager->persist($chargementFruit);
            $entityManager->flush();
            
            
            //$fruit->$this->setQuantiteStock($stockRestant);

        return $chargementFruit;
        } else {
            throw $this->createNotFoundException("La quantité est insuffisante, stock disponible: $chargementFruit->getFruit()->getQuantiteStock()");
        }

    }

    /**
     * @Rest\Get(path="/{id}", name="chargement_fruit_show",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function show(ChargementFruit $chargementFruit): ChargementFruit    {
        return $chargementFruit;
    }
    
    /**
     * @Rest\Get(path="/chargement/{id}", name="fruit_chargement_index", requirements = {"id"="\d+"})
     * @Rest\View(StatusCode = 200)
     */
    public function showFruitsByChargement(Chargement $chargement): array
    {
        $chargementFruits = $this->getDoctrine()
            ->getRepository(ChargementFruit::class)
            ->findByChargement($chargement);
        $fruitsChargement = [];
        
        foreach ($chargementFruits as $cf)
        {
            $fruitsChargement[] = [
               "quantite" => $cf->getQuantite(),
               "fruit" => $cf->getFruit()
           ];
        }

        return count($fruitsChargement)?$fruitsChargement:[];
    }
    
    /**
     * @Rest\Get(path="/not/chargement/{id}", name="fruit_not_chargement_index", requirements = {"id"="\d+"})
     * @Rest\View(StatusCode = 200)
     */
    public function showFruitsNotInChargement(Chargement $chargement): array
    {
        $Fruits = $this->getDoctrine()
            ->getRepository(Fruit::class)
            ->findAll();
        
        $chargementFruits = $this->getDoctrine()
            ->getRepository(ChargementFruit::class)
            ->findByChargement($chargement);
        
        $fruitsChargement = [];
        
        foreach ($chargementFruits as $cf)
        {
            $fruitsChargement[] = $cf->getFruit();
        }
        
        $fruitsNotInChargement = [];
        $founded = false;
        foreach ($Fruits as $fruit)
        {
            $founded = false;
            foreach ($fruitsChargement as $fc){
                if ($fruit->getId() == $fc->getId()) {
                    $founded = true;
                }
            }
            if(!$founded) {
                array_push($fruitsNotInChargement, $fruit);
            }

        }

        return $fruitsNotInChargement;
    }

    
    /**
     * @Rest\Put(path="/{id}/edit", name="chargement_fruit_edit",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function edit(Request $request, ChargementFruit $chargementFruit): ChargementFruit    {
        $form = $this->createForm(ChargementFruitType::class, $chargementFruit);
        $form->submit(Utils::serializeRequestContent($request));

        $this->getDoctrine()->getManager()->flush();

        return $chargementFruit;
    }
    
    /**
     * @Rest\Put(path="/{id}/clone", name="chargement_fruit_clone",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function cloner(Request $request, ChargementFruit $chargementFruit):  ChargementFruit {
        $em=$this->getDoctrine()->getManager();
        $chargementFruitNew=new ChargementFruit();
        $form = $this->createForm(ChargementFruitType::class, $chargementFruitNew);
        $form->submit(Utils::serializeRequestContent($request));
        $em->persist($chargementFruitNew);

        $em->flush();

        return $chargementFruitNew;
    }

    /**
     * @Rest\Delete("/{id}", name="chargement_fruit_delete",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     */
    public function delete(ChargementFruit $chargementFruit): ChargementFruit    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($chargementFruit);
        $entityManager->flush();

        return $chargementFruit;
    }
    
    /**
     * @Rest\Post("/delete-selection/", name="chargement_fruit_selection_delete")
     * @Rest\View(StatusCode=200)
     */
    public function deleteMultiple(Request $request): array {
        $entityManager = $this->getDoctrine()->getManager();
        $chargementFruits = Utils::getObjectFromRequest($request);
        if (!count($chargementFruits)) {
            throw $this->createNotFoundException("Selectionner au minimum un élément à supprimer.");
        }
        foreach ($chargementFruits as $chargementFruit) {
            $chargementFruit = $entityManager->getRepository(ChargementFruit::class)->find($chargementFruit->id);
            $entityManager->remove($chargementFruit);
        }
        $entityManager->flush();

        return $chargementFruits;
    }
}
