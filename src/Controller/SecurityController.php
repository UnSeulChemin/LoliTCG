<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Page Login
 */
#[Route('/login', name: 'app_')]
class SecurityController extends AbstractController
{
    /**
     * Page Login
     *
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    #[Route(path: '', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // If the user is logged and want to access this page
        if ($this->getUser())
        {
            /* Flash Message */
            $this->addFlash('warning-critical', 'Your are not allowed to do this.');

            /* Redirect */
            return $this->redirectToRoute('app_home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        /* Render */
        return $this->render('pages/security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * Page Logout
     *
     * @return void
     */
    #[Route(path: '/logout', name: 'logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}