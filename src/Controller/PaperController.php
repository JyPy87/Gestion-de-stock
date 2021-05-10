<?php

namespace App\Controller;

use App\Repository\PaperRepository;
use App\Entity\Paper;
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
}
