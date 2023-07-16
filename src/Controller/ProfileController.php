<?php

namespace App\Controller;

use App\Entity\User;

use App\Form\UserEditNameFormType;
use App\Form\UserEditPasswordFormType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Page Profile
 */
#[Route('/profile', name: 'app_')]
class ProfileController extends AbstractController
{
    /**
     * Page Profile
     *
     * @return Response
     */
    #[Route('', name: 'profile')]
    public function index(): Response
    {
        /* Render */
        return $this->render('pages/profile/profile.html.twig');
    }

    /**
     * Page Profile, Update Name
     *
     * @param Request $request
     * @param User $updateUser
     * @param EntityManagerInterface $manager
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @return Response
     */
    #[Route('/update/name/{id}', name: 'profile_name', methods: ['GET', 'POST'])]
    public function profileUpdateName(Request $request, User $updateUser, EntityManagerInterface $manager,
        UserPasswordHasherInterface $userPasswordHasher): Response
    {
        // If the User is not the current User
        if ($this->getUser() !== $updateUser)
        {
            /* Flash Message */
            $this->addFlash('warning-critical', 'Your are not allowed to do this.');

            /* Redirect */
            return $this->redirectToRoute('app_home');
        }

        /* Get Data === $updateUser */

        /* Update Form */
        $updateNameFormUser = $this->createForm(UserEditNameFormType::class, $updateUser);
        $updateNameFormUser->handleRequest($request);

        /* Old Password */
        $oldPassword = $updateNameFormUser->get('oldPassword')->getData();

        if ($updateNameFormUser->isSubmitted() && $updateNameFormUser->isValid() && $userPasswordHasher->isPasswordValid($updateUser, $oldPassword))
        {
            /* UpdatedAt */
            $updateUser->setUpdatedAt(new \DateTimeImmutable());

            /* Get Data */
            $updateUser = $updateNameFormUser->getData();

            /* Treat Data */
            $manager->persist($updateUser);
            $manager->flush();

            /* Flash Message */
            $this->addFlash('success', 'Your name have been successfully edited !');

            /* Redirect */
            return $this->redirectToRoute('app_profile');
        }

        else if ($updateNameFormUser->isSubmitted() && !$updateNameFormUser->isValid())
        {
            /* Flash Message */
            $this->addFlash('warning', 'Complete the following step and try again.');
        }

        else if ($updateNameFormUser->isSubmitted() && !$userPasswordHasher->isPasswordValid($updateUser, $oldPassword))
        {
            /* Flash Message */
            $this->addFlash('warning-password', 'Password doesn\'t match.');
        }
        
        /* Render */
        return $this->render('pages/profile/profile_edit_name.html.twig', compact('updateNameFormUser'));
    }

    /**
     * Page Profile, Update Password
     *
     * @param Request $request
     * @param User $updateUser
     * @param EntityManagerInterface $manager
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @return Response
     */
    #[Route('/update/password/{id}', name: 'profile_password', methods: ['GET', 'POST'])]
    public function profileUpdatePassword(Request $request, User $updateUser, EntityManagerInterface $manager,
        UserPasswordHasherInterface $userPasswordHasher): Response
    {
        // If the User is not the current User
        if ($this->getUser() !== $updateUser)
        {
            /* Flash Message */
            $this->addFlash('warning-critical', 'Your are not allowed to do this.');

            /* Redirect */
            return $this->redirectToRoute('app_home');
        }

        /* Get Data === $updateUser */

        /* Update Form */
        $updatePasswordFormUser = $this->createForm(UserEditPasswordFormType::class, $updateUser);
        $updatePasswordFormUser->handleRequest($request);

        /* Old Password */
        $oldPassword = $updatePasswordFormUser->get('oldPassword')->getData();

        if ($updatePasswordFormUser->isSubmitted() && $updatePasswordFormUser->isValid() && $userPasswordHasher->isPasswordValid($updateUser, $oldPassword))
        {
            /* UpdatedAt */
            $updateUser->setUpdatedAt(new \DateTimeImmutable());

            /* Get Data */
            // encode the plain password
            $updateUser->setPassword(
                $userPasswordHasher->hashPassword(
                    $updateUser,
                    $updatePasswordFormUser->get('plainPassword')->getData()
                )
            );

            /* Treat Data */
            $manager->persist($updateUser);
            $manager->flush();

            /* Flash Message */
            $this->addFlash('success', 'Your password have been successfully edited !');

            /* Redirect */
            return $this->redirectToRoute('app_profile');
        }

        else if ($updatePasswordFormUser->isSubmitted() && !$updatePasswordFormUser->isValid())
        {
            /* Flash Message */
            $this->addFlash('warning', 'Complete the following step and try again.');
        }

        else if ($updatePasswordFormUser->isSubmitted() && !$userPasswordHasher->isPasswordValid($updateUser, $oldPassword))
        {
            /* Flash Message */
            $this->addFlash('warning-old-password', 'Complete the following step and try again.');          
        }

        /* Render */
        return $this->render('pages/profile/profile_edit_password.html.twig', compact('updatePasswordFormUser'));
    }
}