<?php

namespace App\Controller\User;

use App\Entity\Paper;
use App\Form\AddPaperType;
use App\Repository\PaperRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("stock/paper/", name="paper_")
 */
class PaperController extends AbstractController
{
    /**
     * @Route("browse", name="browse")
     */
    public function browse(PaperRepository $paperRepository): Response
    {
        $papers=$paperRepository->findAll();
        return $this->render('stock/paper/browse.html.twig', [
            'papers'=>$papers,
        ]);
    }

    /**
     * @Route("read/{id}", name="read", requirements={"id"="\d+"} )
     */
    public function read(Paper $paper)
    {
        return $this->render('stock/paper/read.html.twig',[
            'paper'=>$paper,
        ]);
    }

}

