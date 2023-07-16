<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Waifu;
use App\Entity\Ennemy;
use App\Entity\Chapter;
use Faker\Factory;
use Faker\Generator;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct(private UserPasswordHasherInterface $passwordEncoder)
    {
        $this->faker = Factory::create('fr FR');
    }

    public function load(ObjectManager $manager): void
    {
        // User Admin
        $user = new User();
        $user->setEmail('admin@lolitcg.com');
        $user->setName('admin');
        $user->setAvatar('default.jpg');
        $user->setLevel(10);
        $user->setPassword($this->passwordEncoder->hashPassword($user, 'azerty'));
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $filler = 1;

        for ($i = 1; $i <= 20; $i++)
        {
            $waifu = new Waifu();
            $waifu->setWaifu('nameless');
            $waifu->setName($filler . '.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($user);
            
            /* Treat Data */
            $manager->persist($waifu);

            /* Filler */
            $filler++;
        }

        /* User Ennemy Table, Relation */

        // 1
        $ennemy = new Ennemy();
        $ennemy->setWaifu('Ennemy Weak');
        $ennemy->setName('1.jpg');
        $ennemy->setAtk(100);
        $ennemy->setHp(100);
        $ennemy->setUser($user);
        /* Treat Data */
        $manager->persist($ennemy);

        // 2
        $ennemy = new Ennemy();
        $ennemy->setWaifu('Ennemy Weak');
        $ennemy->setName('2.jpg');
        $ennemy->setAtk(100);
        $ennemy->setHp(100);
        $ennemy->setUser($user);
        /* Treat Data */
        $manager->persist($ennemy);

        // 3
        $ennemy = new Ennemy();
        $ennemy->setWaifu('Boss');
        $ennemy->setName('3.jpg');
        $ennemy->setAtk(300);
        $ennemy->setHp(300);
        $ennemy->setUser($user);
        /* Treat Data */
        $manager->persist($ennemy);  

        /* Admin Chapter Table, Relation */

        // 1
        $chapter = new Chapter();
        $chapter->setChapter('Chapter 1');
        $chapter->setTitle('The dragon\'s child');
        $chapter->setUser($user);
        /* Treat Data */
        $manager->persist($chapter);


        // User 1
        $user = new User();
        $user->setEmail($this->faker->email());
        $user->setName($this->faker->name());
        $user->setAvatar('default.jpg');
        $user->setLevel(1);
        $user->setPassword($this->passwordEncoder->hashPassword($user, 'azerty'));
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);

        // User 1 Waifu
        $waifusUserI = [];

        $filler = 1;

        for ($i = 1; $i <= 20; $i++)
        {
            $waifu = new Waifu();
            $waifu->setWaifu('nameless');
            $waifu->setName($filler . '.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($user);

            /* Treat Data */
            $manager->persist($waifu);

            /* Filler */
            $filler++;
        }

        /* User Ennemy Table, Relation */

        // 1
        $ennemy = new Ennemy();
        $ennemy->setWaifu('Ennemy Weak');
        $ennemy->setName('1.jpg');
        $ennemy->setAtk(100);
        $ennemy->setHp(100);
        $ennemy->setUser($user);
        /* Treat Data */
        $manager->persist($ennemy);

        // 2
        $ennemy = new Ennemy();
        $ennemy->setWaifu('Ennemy Weak');
        $ennemy->setName('2.jpg');
        $ennemy->setAtk(100);
        $ennemy->setHp(100);
        $ennemy->setUser($user);
        /* Treat Data */
        $manager->persist($ennemy);

        // 3
        $ennemy = new Ennemy();
        $ennemy->setWaifu('Boss');
        $ennemy->setName('3.jpg');
        $ennemy->setAtk(300);
        $ennemy->setHp(300);
        $ennemy->setUser($user);
        /* Treat Data */
        $manager->persist($ennemy);  

        /* Admin Chapter Table, Relation */

        // 1
        $chapter = new Chapter();
        $chapter->setChapter('Chapter 1');
        $chapter->setTitle('The dragon\'s child');
        $chapter->setUser($user);
        /* Treat Data */
        $manager->persist($chapter);


        // User 2
        $user = new User();
        $user->setEmail($this->faker->email());
        $user->setName($this->faker->name());
        $user->setAvatar('default.jpg');
        $user->setLevel(1);
        $user->setPassword($this->passwordEncoder->hashPassword($user, 'azerty'));
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);

        $filler = 1;

        for ($i = 1; $i <= 20; $i++)
        {
            $waifu = new Waifu();
            $waifu->setWaifu('nameless');
            $waifu->setName($filler . '.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($user);

            /* Treat Data */
            $manager->persist($waifu);

            /* Filler */
            $filler++;
        }

        /* User Ennemy Table, Relation */

        // 1
        $ennemy = new Ennemy();
        $ennemy->setWaifu('Ennemy Weak');
        $ennemy->setName('1.jpg');
        $ennemy->setAtk(100);
        $ennemy->setHp(100);
        $ennemy->setUser($user);
        /* Treat Data */
        $manager->persist($ennemy);

        // 2
        $ennemy = new Ennemy();
        $ennemy->setWaifu('Ennemy Weak');
        $ennemy->setName('2.jpg');
        $ennemy->setAtk(100);
        $ennemy->setHp(100);
        $ennemy->setUser($user);
        /* Treat Data */
        $manager->persist($ennemy);

        // 3
        $ennemy = new Ennemy();
        $ennemy->setWaifu('Boss');
        $ennemy->setName('3.jpg');
        $ennemy->setAtk(300);
        $ennemy->setHp(300);
        $ennemy->setUser($user);
        /* Treat Data */
        $manager->persist($ennemy);  

        /* Admin Chapter Table, Relation */

        // 1
        $chapter = new Chapter();
        $chapter->setChapter('Chapter 1');
        $chapter->setTitle('The dragon\'s child');
        $chapter->setUser($user);
        /* Treat Data */
        $manager->persist($chapter);


        // User 3
        $user = new User();
        $user->setEmail($this->faker->email());
        $user->setName($this->faker->name());
        $user->setAvatar('default.jpg');
        $user->setLevel(1);
        $user->setPassword($this->passwordEncoder->hashPassword($user, 'azerty'));
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);

        $filler = 1;

        for ($i = 1; $i <= 20; $i++)
        {
            $waifu = new Waifu();
            $waifu->setWaifu('nameless');
            $waifu->setName($filler . '.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($user);

            /* Treat Data */
            $manager->persist($waifu);

            /* Filler */
            $filler++;
        }

        /* User Ennemy Table, Relation */

        // 1
        $ennemy = new Ennemy();
        $ennemy->setWaifu('Ennemy Weak');
        $ennemy->setName('1.jpg');
        $ennemy->setAtk(100);
        $ennemy->setHp(100);
        $ennemy->setUser($user);
        /* Treat Data */
        $manager->persist($ennemy);

        // 2
        $ennemy = new Ennemy();
        $ennemy->setWaifu('Ennemy Weak');
        $ennemy->setName('2.jpg');
        $ennemy->setAtk(100);
        $ennemy->setHp(100);
        $ennemy->setUser($user);
        /* Treat Data */
        $manager->persist($ennemy);

        // 3
        $ennemy = new Ennemy();
        $ennemy->setWaifu('Boss');
        $ennemy->setName('3.jpg');
        $ennemy->setAtk(300);
        $ennemy->setHp(300);
        $ennemy->setUser($user);
        /* Treat Data */
        $manager->persist($ennemy);  

        /* Admin Chapter Table, Relation */

        // 1
        $chapter = new Chapter();
        $chapter->setChapter('Chapter 1');
        $chapter->setTitle('The dragon\'s child');
        $chapter->setUser($user);
        /* Treat Data */
        $manager->persist($chapter);

        $manager->flush();
    }
}