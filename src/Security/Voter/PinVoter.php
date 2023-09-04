<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class PinVoter extends Voter
{
    public const CREATE = 'PIN_CREATE';
    public const MANAGE = 'PIN_MANAGE';

    protected function supports(string $attribute, $subject): bool
    {
        return $attribute === self::CREATE || in_array($attribute, [self::MANAGE])
            && $subject instanceof \App\Entity\Pin;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case self::CREATE:
                return $user->isVerified();
            case self::MANAGE:
                return $user->isVerified() && $user == $subject->getUser();
        }

        return false;
    }
}
