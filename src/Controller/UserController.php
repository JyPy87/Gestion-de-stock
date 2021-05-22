<?php

namespace App\Controller;

use App\Form\UserPasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user/", name="user_")
 */
class UserController extends AbstractController
{
  /**
     * @Route("edit/password", name="edit_password")
     */
    public function editPassword(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = $this->getUser();

        $form = $this->createForm(UserPasswordType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $this->addFlash('success', 'Mot de passe modifié.');

            return $this->redirectToRoute('user_profile');
        }

        return $this->render('user/edit_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
