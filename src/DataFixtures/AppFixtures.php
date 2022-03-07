<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager): void
    {
        $users = [
            ["Admin","Gilles","Ros","gilles.ros@laposte.net","ROLE_ADMIN","mdp"],
            ["Jeannot","Jean","Bonbeur","jean@gmail.com","ROLE_USER","mdp"]
        ];
        
        foreach($users as $u){
            $user = new User();

            $password = $this->encoder->hashPassword($user, $u[5]);
            $user   ->setPseudo($u[0])
                    ->setPrenom($u[1])
                    ->setNom($u[2])
                    ->setEmail($u[3])
                    ->setRoles([$u[4]])
                    ->setPassword($password)
            ;

            $manager->persist($user);
        }
        // $manager->persist($product);

        $manager->flush();
    }
}
