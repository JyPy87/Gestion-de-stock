<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EnvelopeController extends AbstractController
{
    /**
     * @Route("/envelope", name="envelope")
     */
    public function index(): Response
    {
        return $this->render('envelope/index.html.twig', [
            'controller_name' => 'EnvelopeController',
        ]);
    }
}
