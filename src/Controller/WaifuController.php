<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Waifu;
use App\Repository\WaifuRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Page Waifu
 */
#[Route('/waifu', name: 'app_')]
class WaifuController extends AbstractController
{
    /**
     * Page Waifu
     *
     * @param WaifuRepository $waifu
     * @param PaginatorInterface $paginator
     * @return Response
     */
    #[Route('', name: 'waifu')]
    public function waifu(WaifuRepository $waifu, PaginatorInterface $paginator): Response
    {
        /* Fetch Current User */
        $user = $this->getUser()->getId();

        /* Paginator */
        $waifus = $paginator->paginate(
            $waifu->findBy(['user' => $user], ['id' => 'DESC']),
            $number ?? 1, /* page number */ 8 /* limit per page */
        );

        /* Render */
        return $this->render('pages/waifu/waifu.html.twig', compact('waifus')); 
    }

    /**
     * Page Waifu, Page
     *
     * @param integer $number
     * @param WaifuRepository $waifu
     * @param PaginatorInterface $paginator
     * @return Response
     */
    #[Route('/page/{number}', name: 'waifu_page', methods: ['GET'])]
    public function waifuPage(int $number, WaifuRepository $waifu, PaginatorInterface $paginator): Response
    {
        /* Fetch Current User */
        $user = $this->getUser()->getId();

        /* Paginator */
        $waifus = $paginator->paginate(
            $waifu->findBy(['user' => $user], ['id' => 'DESC']),
            $number ?? 1, /* page number */ 8 /* limit per page */
        );

        /* Render */
        return $this->render('pages/waifu/waifu.html.twig', compact('waifus')); 
    }

    /**
     * Page Waifu, Info
     *
     * @param Waifu $waifu
     * @return Response
     */
    #[Route('/info/{id}', name: 'waifu_info', methods: ['GET', 'POST'])]
    public function waifuInfo(Waifu $waifu): Response
    {
        // If the User want to access other User Waifu Id
        if ($this->getUser()->getId() !== $waifu->getUser()->getId())
        {
            /* Flash Message */
            $this->addFlash('warning-critical', 'Your are not allowed to do this.');

            /* Redirect */
            return $this->redirectToRoute('app_home');
        }

        /* Render */
        return $this->render('pages/waifu/waifu_info.html.twig', compact('waifu'));       
    }

    /**
     * Page Waifu, Set Avatar
     *
     * @param Waifu $waifu
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/info/set-avatar/{id}', name: 'waifu_info_set_avatar', methods: ['GET', 'POST'])]
    public function waifuInfoSetAvatar(Waifu $waifu, EntityManagerInterface $manager): Response
    {
        /* Get Data */
        $user = $this->getUser()->setAvatar($waifu->getName());

        /* Treat Data */
        $manager->persist($user);
        $manager->flush();

        /* Flash Message */
        $this->addFlash('success', 'Your avatar have been successfully edited !');

        /* Redirect */
        return $this->redirectToRoute('app_home');
    }
}