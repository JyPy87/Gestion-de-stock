<?php

namespace App\Controller;

use App\Entity\Supply;
use App\Form\AddSupplyType;
use App\Form\SupplyType;
use App\Repository\SupplyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("supply/", name="supply_")
 */
class SupplyController extends AbstractController
{
    /**
     * @Route("browse", name="browse")
     */
    public function browse(SupplyRepository $supplyRepository): Response
    {
        $supplies=$supplyRepository->findAll();
        return $this->render('supply/browse.html.twig', [
            'supplies'=>$supplies,
        ]);
    }

    /**
     * @Route("read/{id}", name="item", requirements={"id"="\d+"} )
     */
    public function read(Supply $supply)
    {
        return $this->render('supply/read.html.twig',[
            'supply'=>$supply,
        ]);
    }

    /**
     * @Route("edit/{id}", name="edit", requirements={"id"="\d+"})
     */
    public function edit(Supply $supply, Request $request): Response
    {
       
        $form = $this->createForm(AddSupplyType::class, $supply);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
          
            $supply->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('supply_browse');
        }  
        return $this->render('supply/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("add", name="add")
     */
    public function add(Request $request, EntityManagerInterface $em)
    {
        $supply = new Supply;

        $form = $this->createForm(AddSupplyType::class, $supply);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $supply->setCreatedAt(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($supply);
            $em->flush();

            return $this->redirectToRoute('supply_browse');
        }
        return $this->render('supply/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("delete/{id}", name="delete")
     */
    public function delete(Supply $supply)
    {
       // $this->denyAccessUnlessGranted('DELETE',$supply);

        $em = $this->getDoctrine()->getManager();
        $em->remove($supply);
        $em->flush();

        // On redirige sur la liste des départements
        return $this->redirectToRoute('supply_browse');
    }
    
}
