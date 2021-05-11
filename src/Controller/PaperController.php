<?php

namespace App\Controller;

use App\Entity\Paper;
use App\Repository\PaperRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(name="paper_")
 */
class PaperController extends AbstractController
{
    /**
     * @Route("/paper/list", name="list")
     */
    public function list(PaperRepository $paperRepository): Response
    {
        $papers=$paperRepository->findAll();
        if(!empty($papers)){
            dump($papers);
        }
        return $this->render('paper/list.html.twig', [
            'papers'=>$papers,
        ]);
    }

    /**
     * @Route("/paper/{id}", name="item", requirements={"id"="\d+"} )
     */
    public function item(Paper $paper)
    {
        return $this->render('paper/item.html.twig',[
            'paper'=>$paper,
        ]);
    }
    /**
     * @Route("/paper/add", name="add")
     */
    public function add(EntityManagerInterface $em){

        $paper = new Paper();
        $paper->setName('AAA');
        $paper->setReference('BBB');
        $em->persist($paper);
        $em->flush();
        return $this->redirectToRoute('paper_list');
    }
}

