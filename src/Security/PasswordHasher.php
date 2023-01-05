<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PasswordHasher implements PasswordHasherInterface
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }
    public function hash(string $password): string
    {
        $user = new User();
        $user->setPassword($password);
        // hash the password (based on the password hasher factory config for the $user class)
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $password
        );
        $user->setPassword($hashedPassword);

        // In another action (e.g. to confirm deletion), you can verify the password
        if (!$this->passwordHasher->isPasswordValid($user, $password)) {
            throw new \Exception('Bad credentials, cannot delete this user.');
        }
        return $hashedPassword;
    }
    public function verify(string $hashedPassword, string $password): bool
    {
        if ($hashedPassword !== $password) {
            return true;
        }
        return false;
    }
    public function needsRehash(string $hashedPassword): bool
    {
        if ($hashedPassword) {
            return true;
        }
        return false;
    }
}
