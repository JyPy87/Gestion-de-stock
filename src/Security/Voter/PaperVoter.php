<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class PaperVoter extends Voter
{
    protected function supports(string $attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['ADD', 'EDIT','DELETE'])
            && $subject instanceof \App\Entity\Paper;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'ADD':
                // logic to determine if the user can EDIT
                // return true or false
                if( in_array('ROLE_ADMIN',$user->getRoles())){

                    return true;
                }
                break;
            case 'EDIT':
                if( in_array('ROLE_ADMIN',$user->getRoles())){

                    return true;
                }
                break;
            case 'DELETE':
                if( in_array('ROLE_ADMIN',$user->getRoles())){

                    return true;
                }
                break;
        }

        return false;
    }
}
