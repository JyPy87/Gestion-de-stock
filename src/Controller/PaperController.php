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
 * @Route("/paper/", name="paper_")
 */
class PaperController extends AbstractController
{
    /**
     * @Route("list", name="list")
     */
    public function list(PaperRepository $paperRepository): Response
    {
        $papers=$paperRepository->findAll();
        return $this->render('paper/list.html.twig', [
            'papers'=>$papers,
        ]);
    }

    /**
     * @Route("{id}", name="item", requirements={"id"="\d+"} )
     */
    public function item(Paper $paper)
    {
        return $this->render('paper/item.html.twig',[
            'paper'=>$paper,
        ]);
    }
    /**
     * @Route("add", name="add")
     */
    public function add(Request $request, EntityManagerInterface $em){

        $paper = new Paper();
        $form = $this->createForm(AddPaperType::class,$paper);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // Si tout est bon, on récupère l'EntityManager, on periste $recipe et on flushe

            $paper->setCreatedAt(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($paper);
            $em->flush();

            return $this->redirectToRoute('paper_list');
        }
        return $this->render('paper/add.html.twig',[
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("delete/{id}", name="delete")
     */
    public function delete(Paper $paper)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($paper);
        $em->flush();

        // On redirige sur la liste des départements
        return $this->redirectToRoute('paper_list');

    }
}

