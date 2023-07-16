<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Waifu;
use App\Entity\Ennemy;
use App\Entity\Chapter;

use App\Form\RegistrationFormType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use App\Security\UserAuthenticator;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Page Register
 */
#[Route('/register', name: 'app_')]
class RegistrationController extends AbstractController
{
    /**
     * Page Register, Create
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @param UserAuthenticatorInterface $userAuthenticator
     * @param UserAuthenticator $authenticator
     * @return Response
     */
    #[Route('', name: 'register')]
    public function register(Request $request, EntityManagerInterface $manager, 
        UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator,
        UserAuthenticator $authenticator
        ): Response
    {
        // If the user is logged and want to access this page
        if ($this->getUser())
        {
            /* Flash Message */
            $this->addFlash('warning-critical', 'Your are not allowed to do this.');

            /* Redirect */
            return $this->redirectToRoute('app_home');
        }

        /* Create Data */
        $createUser = new User();
        $createUser->setAvatar('default.jpg');
        $createUser->setLevel(1);
        $createUser->setRoles(['ROLE_USER']);

        /* Create Form */
        $createFormUser = $this->createForm(RegistrationFormType::class, $createUser);
        $createFormUser->handleRequest($request);

        if ($createFormUser->isSubmitted() && $createFormUser->isValid())
        {
            /* Get Data */
            // encode the plain password
            $createUser->setPassword(
                $userPasswordHasher->hashPassword(
                    $createUser,
                    $createFormUser->get('plainPassword')->getData()
                )
            );

            /* Treat Data */
            $manager->persist($createUser);

            /* Waifu Table, Relation */

            // 1
            $waifu = new Waifu();
            $waifu->setWaifu('Eyjafjalla (EX)');
            $waifu->setName('1.jpg');
            $waifu->setAtk(300);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);
    
            // 2
            $waifu = new Waifu();
            $waifu->setWaifu('Eyjafjalla (Serie 1)');
            $waifu->setName('2.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);

            // 3
            $waifu = new Waifu();
            $waifu->setWaifu('Eyjafjalla (Serie 2)');
            $waifu->setName('3.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);

            // 4
            $waifu = new Waifu();
            $waifu->setWaifu('Saber Epee');
            $waifu->setName('4.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);

            // 5
            $waifu = new Waifu();
            $waifu->setWaifu('Saber Epee');
            $waifu->setName('5.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);

            // 6
            $waifu = new Waifu();
            $waifu->setWaifu('Saber Epee');
            $waifu->setName('6.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);

            // 7
            $waifu = new Waifu();
            $waifu->setWaifu('Rin Tohsaka');
            $waifu->setName('7.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);
    
            // 8
            $waifu = new Waifu();
            $waifu->setWaifu('Momento Bunny');
            $waifu->setName('8.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);

            // 9
            $waifu = new Waifu();
            $waifu->setWaifu('Saber Epee');
            $waifu->setName('9.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);

            // 10
            $waifu = new Waifu();
            $waifu->setWaifu('Saber Epee');
            $waifu->setName('10.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);

            // 11
            $waifu = new Waifu();
            $waifu->setWaifu('Saber Epee');
            $waifu->setName('11.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);

            // 12
            $waifu = new Waifu();
            $waifu->setWaifu('Saber Epee');
            $waifu->setName('12.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);

            // 13
            $waifu = new Waifu();
            $waifu->setWaifu('Momento Bunny');
            $waifu->setName('13.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);

            // 14
            $waifu = new Waifu();
            $waifu->setWaifu('Saber Epee');
            $waifu->setName('14.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);

            // 15
            $waifu = new Waifu();
            $waifu->setWaifu('Saber Epee');
            $waifu->setName('15.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);

            // 16
            $waifu = new Waifu();
            $waifu->setWaifu('Saber Epee');
            $waifu->setName('16.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);

            // 17
            $waifu = new Waifu();
            $waifu->setWaifu('Saber Epee');
            $waifu->setName('17.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);

            // 18
            $waifu = new Waifu();
            $waifu->setWaifu('Rin Tohsaka');
            $waifu->setName('18.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);
    
            // 19
            $waifu = new Waifu();
            $waifu->setWaifu('Momento Bunny');
            $waifu->setName('19.jpg');
            $waifu->setAtk(150);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);

            // 20
            $waifu = new Waifu();
            $waifu->setWaifu('Saber Epee');
            $waifu->setName('20.jpg');
            $waifu->setAtk(300);
            $waifu->setHp(150);
            $waifu->setClass('Archer');
            $waifu->setLevel(1);
            $waifu->setGender('Girl');
            $waifu->setUser($createUser);
            /* Treat Data */
            $manager->persist($waifu);

            /* Ennemy Table, Relation */

            // 1
            $ennemy = new Ennemy();
            $ennemy->setWaifu('Ennemy Weak');
            $ennemy->setName('1.jpg');
            $ennemy->setAtk(100);
            $ennemy->setHp(100);
            $ennemy->setUser($createUser);
            /* Treat Data */
            $manager->persist($ennemy);

            // 2
            $ennemy = new Ennemy();
            $ennemy->setWaifu('Ennemy Weak');
            $ennemy->setName('2.jpg');
            $ennemy->setAtk(100);
            $ennemy->setHp(100);
            $ennemy->setUser($createUser);
            /* Treat Data */
            $manager->persist($ennemy);

            // 3
            $ennemy = new Ennemy();
            $ennemy->setWaifu('Boss');
            $ennemy->setName('3.jpg');
            $ennemy->setAtk(300);
            $ennemy->setHp(300);
            $ennemy->setUser($createUser);
            /* Treat Data */
            $manager->persist($ennemy);

            /* Chapter Table, Relation */

            // 1
            $chapter = new Chapter();
            $chapter->setChapter('Chapter 1');
            $chapter->setTitle('The dragon\'s child');
            $chapter->setUser($createUser);
            /* Treat Data */
            $manager->persist($chapter);

            /* Treat Data */
            $manager->flush();

            // do anything else you need here, like send an email

            /* Redirect */
            return $userAuthenticator->authenticateUser(
                $createUser,
                $authenticator,
                $request
            );
        }

        else if ($createFormUser->isSubmitted() && !$createFormUser->isValid())
        {
            /* Flash Message */
            $this->addFlash('warning', 'Complete the following step and try again.');
        }

        /* Redirect */
        return $this->render('pages/security/register.html.twig', [
            'createFormUser' => $createFormUser->createView(),
        ]);
    }
}