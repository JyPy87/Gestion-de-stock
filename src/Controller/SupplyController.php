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
 * @Route("supply/", name="supply_")
 */
class SupplyController extends AbstractController
{
    /**
     * @Route("browse", name="browse")
     */
    public function browse(SupplyRepository $paperRepository): Response
    {
        $supplies=$paperRepository->findAll();
        return $this->render('supply/browse.html.twig', [
            'supplies'=>$supplies,
        ]);
    }

    /**
     * @Route("{id}", name="item", requirements={"id"="\d+"} )
     */
    public function item(Supply $supply)
    {
        return $this->render('supply/item.html.twig',[
            'supply'=>$supply,
        ]);
    }
    
}
