<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public const USER_ADMIN_REFERENCE = 'user-admin';

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('en_US');

        for ($i = 1; $i <= 9; $i++) {
            $user = new User();
            $user
                ->setEmail($faker->email())
                ->setPassword($faker->password())
                ->setUsername($faker->userName());
            $manager->persist($user);
        }

        $userAdmin = new User();
        $userAdmin
            ->setEmail('admin@vl.com')
            ->setPassword('admin')
            ->setUsername('admin')
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($userAdmin);
        
        $manager->flush();
        $this->addReference(self::USER_ADMIN_REFERENCE, $userAdmin);
    }
}
