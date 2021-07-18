<?php

namespace App\Controller;

use App\Entity\Information;
use App\Repository\InformationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("main/")
 */
class MainController extends AbstractController
{
    /**
     * @Route("", name="home")
     */
    public function index(InformationRepository $informationRepository): Response
    {
        $informations = $informationRepository->findAll();
        return $this->render('main/index.html.twig', [
            'infos'=>$informations           
        ]);
    }
}
