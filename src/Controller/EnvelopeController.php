<?php

namespace App\Controller;

use App\Entity\Envelope;
use App\Form\AddEnvelopeType;
use App\Repository\EnvelopeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        $envelopes = $envelopeRepository->findAll();
        return $this->render('envelope/browse.html.twig', [
            'envelopes' => $envelopes,
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

     /**
     * @Route("add", name="add")
     */
    public function add(Request $request, EntityManagerInterface $em)
    {
        $envelope = new Envelope;

        //$this->denyAccessUnlessGranted('ADD',$envelope);

        $form = $this->createForm(AddEnvelopeType::class, $envelope);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $envelope->setCreatedAt(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($envelope);
            $em->flush();

            return $this->redirectToRoute('envelope_browse');
        }
        return $this->render('envelope/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("delete/{id}", name="delete")
     */
    public function delete(Envelope $envelope)
    {
        // $this->denyAccessUnlessGranted('DELETE',$envelope);

        $em = $this->getDoctrine()->getManager();
        $em->remove($envelope);
        $em->flush();

        // On redirige sur la liste des départements
        return $this->redirectToRoute('envelope_browse');
    }
}
