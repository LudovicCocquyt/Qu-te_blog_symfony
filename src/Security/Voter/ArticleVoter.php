<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;


class ArticleVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        return in_array($attribute, ['EDIT'])
            && $subject instanceof \App\Entity\Article;
    }

    protected function voteOnAttribute($attribute, $article, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }
        if(null ==$article->getAuthor()){
            return false;
        }

        switch ($attribute) {
            case 'EDIT':
                return $article->getAuthor()->getId() == $user->getId();
                break;
            // case 'POST_VIEW':
            //     break;
        }

        return false;
    }
}
