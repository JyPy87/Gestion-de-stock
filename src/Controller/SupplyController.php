<?php

namespace App\Controller;

use App\Entity\Supply;
use App\Form\SupplyType;
use App\Repository\SupplyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/supply/", name="supply_")
 */
class SupplyController extends AbstractController
{
    /**
     * @Route("list", name="list")
     */
    public function list(SupplyRepository $paperRepository): Response
    {
        $supplies=$paperRepository->findAll();
        return $this->render('supply/list.html.twig', [
            'supplies'=>$supplies,
        ]);
    }

    /**
     * @Route("{id}", name="item", requirements={"id"="\d+"} )
     */
    public function item(Supply $supply)
    {
        return $this->render('paper/item.html.twig',[
            'supply'=>$supply,
        ]);
    }
    
}
