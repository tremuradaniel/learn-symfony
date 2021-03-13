<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        for ($i = 1; $i <= 5; $i++) {
            $user = new User();

            $user->setName('name - ' . $i);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
