<?php

namespace App\Controller;

use App\Entity\Consumable;
use App\Form\AddconsumableType;
use App\Repository\ConsumableRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("consumable/", name="consumable_")
 */
class ConsumableController extends AbstractController
{
    /**
     * @Route("browse", name="browse")
     */
    public function browse(ConsumableRepository $consumableRepository): Response
    {
        $consumable=$consumableRepository->findAll();
        return $this->render('consumable/browse.html.twig', [
            'consumables'=>$consumable,
        ]);
    }

    /**
     * @Route("read/{id}", name="item", requirements={"id"="\d+"} )
     */
    public function read(Consumable $consumable)
    {
        return $this->render('consumable/read.html.twig',[
            'consumable'=>$consumable,
        ]);
    }

    /**
     * @Route("edit/{id}", name="edit", requirements={"id"="\d+"})
     */
    public function edit(Consumable $consumable, Request $request): Response
    {
       
        $form = $this->createForm(AddConsumableType::class, $consumable);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
          
            $consumable->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('consumable_browse');
        }  
        return $this->render('consumable/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("add", name="add")
     */
    public function add(Request $request, EntityManagerInterface $em)
    {
        $consumable = new Consumable;

        $form = $this->createForm(AddconsumableType::class, $consumable);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $consumable->setCreatedAt(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($consumable);
            $em->flush();

            return $this->redirectToRoute('consumable_browse');
        }
        return $this->render('consumable/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("delete/{id}", name="delete")
     */
    public function delete(Consumable $consumable)
    {
       // $this->denyAccessUnlessGranted('DELETE',$consumable);

        $em = $this->getDoctrine()->getManager();
        $em->remove($consumable);
        $em->flush();

        // On redirige sur la liste des départements
        return $this->redirectToRoute('consumable_browse');
    }
    
}
