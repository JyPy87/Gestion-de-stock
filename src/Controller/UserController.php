<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserPasswordType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user/", name="user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("browse", name="browse")
     */
    public function browse(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('user/browse.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("edit/password", name="edit_password")
     */
    public function editPassword(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = $this->getUser();

        $this->denyAccessUnlessGranted('EDIT_PASSWORD', $user);

        $form = $this->createForm(UserPasswordType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $this->addFlash('success', 'Mot de passe modifié.');

            return $this->redirectToRoute('home');
        }

        return $this->render('user/edit_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("delete/{id}", name="delete")
     */
    public function delete(User $user)
    {
      
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        // On redirige sur la liste des départements
        return $this->redirectToRoute('user_browse');
    }
}
