<?php

namespace App\Services;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class Compteur
{

    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    public function leTempsQuiPasse(UserInterface $user){

        $tempsDejaPasse = $user->getTempsCo();
        $user->setTempsCo($tempsDejaPasse+1);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}