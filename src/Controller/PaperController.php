<?php

namespace App\Controller;

use App\Entity\Paper;
use App\Form\AddPaperType;
use App\Repository\PaperRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("paper/", name="paper_")
 */

class PaperController extends AbstractController
{
    /**
     * @Route("browse", name="browse")
     */
    public function browse(PaperRepository $paperRepository): Response
    {
        $papers = $paperRepository->findAll();
        return $this->render('paper/browse.html.twig', [
            'papers' => $papers,
        ]);
    }

    /**
     * @Route("read/{id}", name="read", requirements={"id"="\d+"} )
     */
    public function read(Paper $paper)
    {
        return $this->render('paper/read.html.twig', [
            'paper' => $paper,
        ]);
    }

    /**
     * @Route("edit/{id}", name="edit", requirements={"id"="\d+"})
     */
    public function edit(Paper $paper, Request $request): Response
    {
       
        $form = $this->createForm(AddPaperType::class, $paper);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
          
            $paper->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('paper_browse');
        }  
        return $this->render('paper/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("add", name="add")
     */
    public function add(Request $request, EntityManagerInterface $em)
    {
        $paper = new Paper;

        //$this->denyAccessUnlessGranted('ADD',$paper);

        $form = $this->createForm(AddPaperType::class, $paper);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $paper->setCreatedAt(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($paper);
            $em->flush();

            return $this->redirectToRoute('paper_browse');
        }
        return $this->render('paper/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("delete/{id}", name="delete")
     */
    public function delete(Paper $paper)
    {
         $this->denyAccessUnlessGranted('DELETE',$paper);
        $em = $this->getDoctrine()->getManager();
        $em->remove($paper);
        $em->flush();

        return $this->redirectToRoute('paper_browse');
    }
}
