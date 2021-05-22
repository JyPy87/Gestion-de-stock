<?php

namespace App\Controller\Admin;

use App\Entity\Paper;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("stock\admin\", name="paper_")
 */
class PaperController extends AbstractController
{
      /**
     * @Route("add", name="add")
     */
    public function add(Request $request, EntityManagerInterface $em){

        $paper = new Paper();
        $form = $this->createForm(AddPaperType::class,$paper);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

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
        return $this->redirectToRoute('paper_browse');

    }
}
