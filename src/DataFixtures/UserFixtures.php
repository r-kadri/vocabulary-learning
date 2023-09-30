<?php

namespace App\DataFixtures;

use App\Entity\Language;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public const USER_ADMIN_REFERENCE = 'user-admin';

    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher
    ) {}

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
        $languages = $this->entityManager->getRepository(Language::class)->findAll();
        $user = new User();
        $user
            ->setEmail($faker->email())
            ->setPassword($this->passwordHasher->hashPassword($user, $faker->password()))
            ->setUsername($faker->userName())
            ->addLanguage($faker->randomElement($languages))
            ->addLanguage($faker->randomElement($languages))
            ->addLanguage($faker->randomElement($languages));
        return $user;
    }

    private function getAdminUser(): User {
        $userAdmin = new User();
        $userAdmin
            ->setEmail('admin@vl.com')
            ->setPassword($this->passwordHasher->hashPassword($userAdmin, 'admin'))
            ->setUsername('admin')
            ->setRoles(['ROLE_ADMIN'])
            ->addLanguage($this->getReference(LanguageFixtures::LANGUAGE_ENGLISH_REFERENCE));
        return $userAdmin;
    }

    public function getDependencies(): array
    {
        return [
            LanguageFixtures::class
        ];
    }
}
