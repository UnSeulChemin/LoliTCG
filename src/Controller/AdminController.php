<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\Edit\UserEditFormType;
use App\Repository\WaifuRepository;
use App\Repository\EnnemyRepository;
use App\Repository\ChapterRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Page Admin
 */
#[Route('/admin', name: 'app_')]
class AdminController extends AbstractController
{
    /**
     * Page Admin
     *
     * @return Response
     */
    #[Route('', name: 'admin')]
    public function admin(): Response
    {
        /* Render */
        return $this->render('pages/admin/admin.html.twig');
    }

    /**
     * Page Admin, Read Users
     *
     * @param UserRepository $repository
     * @return Response
     */
    #[Route('/users', name: 'admin_users', methods: ['GET'])]
    public function readUsers(UserRepository $repository): Response
    {
        // Find By Roles, UserRepository Function
        $users = $repository->findByRoles('ROLE_USER');

        /* Render */
        return $this->render('pages/admin/admin_users.html.twig', compact('users'));
    }

    /**
     * Page Admin, Update User
     *
     * @param Request $request
     * @param User $updateUser
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/users/update/{id}', name: 'admin_user_edit', methods: ['GET', 'POST'])]
    public function editUser(Request $request, User $updateUser, EntityManagerInterface $manager): Response
    {
        /* Get Data === $updateUser */

        /* Update Form */
        $updateFormUser = $this->createForm(UserEditFormType::class, $updateUser);
        $updateFormUser->handleRequest($request);

        if ($updateFormUser->isSubmitted() && $updateFormUser->isValid())
        {
            /* UpdatedAt */
            $updateUser->setUpdatedAt(new \DateTimeImmutable());

            /* Get Data */
            $updateUser = $updateFormUser->getData();

            /* Treat Data */
            $manager->persist($updateUser);
            $manager->flush();

            /* Redirect */
            return $this->redirectToRoute('app_admin_users');
        }

        else if ($updateFormUser->isSubmitted() && !$updateFormUser->isValid())
        {
            /* Flash Message */
            $this->addFlash('warning', 'Complete the following step and try again.');
        }

        /* Render */
        return $this->render('pages/admin/admin_user_edit.html.twig', compact('updateFormUser'));
    }

    /**
     * Page Admin, Delete User
     *
     * @param User $user
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/users/delete/{id}', name: 'admin_user_delete', methods: ['GET'])]
    public function deleteUser(User $user, EntityManagerInterface $manager): Response
    {
        /* Treat Data */
        $manager->remove($user);
        $manager->flush();

        /* Redirect */
        return $this->redirectToRoute('app_admin_users');
    }

    /**
     * Page Admin, Read Admins
     *
     * @param UserRepository $repository
     * @return Response
     */
    #[Route('/admins', name: 'admin_admins', methods: ['GET'])]
    public function readAdmins(UserRepository $repository): Response
    {
        // Find By Roles, UserRepository Function
        $admins = $repository->findByRoles('ROLE_ADMIN');

        /* Render */
        return $this->render('pages/admin/admin_admins.html.twig', compact('admins'));
    }

    /**
     * Page Admin Read Datas
     *
     * @param UserRepository $user_repo
     * @param WaifuRepository $waifu_repo
     * @return Response
     */
    #[Route('/datas', name: 'admin_datas', methods: ['GET'])]
    public function readData(UserRepository $user_repo, WaifuRepository $waifu_repo, EnnemyRepository $ennemy_repo, ChapterRepository $chapter_repo): Response
    {
        $users = $user_repo->findAll();
        $waifus = $waifu_repo->findAll();
        $ennemys = $ennemy_repo->findAll();
        $chapters = $chapter_repo->findAll();

        // Find By Roles, UserRepository Function
        $users = $user_repo->findByRoles("ROLE_USER");
        $admins = $user_repo->findByRoles("ROLE_ADMIN");

        return $this->render('pages/admin/admin_datas.html.twig', compact('users', 'waifus', 'ennemys', 'chapters', 'users', 'admins'));
    }    
}