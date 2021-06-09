<?php

namespace App\Controller;

use App\Form\AddEnvelopeType;
use App\Repository\EnvelopeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Envelope;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("envelope/", name="envelope_")
 */
class EnvelopeController extends AbstractController
{
    /**
     * @Route("browse", name="browse")
     */
    public function browse(EnvelopeRepository $envelopeRepository): Response
    {
        $envelope = $envelopeRepository->findAll();
        return $this->render('envelope/browse.html.twig', [
            'envelope' => $envelope,
        ]);
    }

    /**
     * @Route("read/{id}", name="read", requirements={"id"="\d+"} )
     */
    public function read(Envelope $envelope)
    {
        return $this->render('envelope/read.html.twig', [
            'envelope' => $envelope,
        ]);
    }

    /**
     * @Route("edit/{id}", name="edit", requirements={"id"="\d+"})
     */
    public function edit(Envelope $envelope, Request $request): Response
    {

        $form = $this->createForm(AddEnvelopeType::class, $envelope);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $envelope->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('Envelope_browse');
        }
        return $this->render('Envelope/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
