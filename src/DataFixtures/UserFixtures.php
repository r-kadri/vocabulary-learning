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
        // Create 10 fake users
        for ($i = 0; $i < 10; $i++) {
            $manager->persist($this->getFakeUser());
        }

        // Create a fake admin user
        $userAdmin = $this->getAdminUser();
        $manager->persist($userAdmin);

        $manager->flush();
        $this->addReference(self::USER_ADMIN_REFERENCE, $userAdmin);
    }

    private function getFakeUser(string $locale = 'en_US'): User {
        $faker = Factory::create($locale);
        $user = new User();
        $user
            ->setEmail($faker->email())
            ->setPassword($faker->password())
            ->setUsername($faker->userName());
        return $user;
    }

    private function getAdminUser(): User {
        $userAdmin = new User();
        $userAdmin
            ->setEmail('admin@vl.com')
            ->setPassword('admin')
            ->setUsername('admin')
            ->setRoles(['ROLE_ADMIN']);
        return $userAdmin;
    }
}
