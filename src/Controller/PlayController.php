<?php

namespace App\Controller;

use App\Entity\Ennemy;
use App\Repository\EnnemyRepository;
use App\Repository\ChapterRepository;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Page Play
 */
#[Route('/play', name: 'app_')]
class PlayController extends AbstractController
{
    /**
     * Page Play
     *
     * @param ChapterRepository $repository
     * @return Response
     */
    #[Route('', name: 'play')]
    public function play(ChapterRepository $repository): Response
    {
        /* Fetch Current User */
        $user = $this->getUser()->getId();

        /* Get Data */
        $chapters = $repository->findBy(['user' => $user], ['id' => 'DESC']);

        /* Render */
        return $this->render('pages/play/play.html.twig', compact('chapters'));
    }

    /**
     * Page Play Chapter, Read
     *
     * @param EnnemyRepository $repository
     * @return Response
     */
    #[Route('/chapter', name: 'chapter', methods: ['GET'])]
    public function playChapter(EnnemyRepository $repository): Response
    {
        /* Fetch Current User */
        $user = $this->getUser()->getId();

        /* Get Data */
        $ennemies = $repository->findBy(['user' => $user], ['id' => 'DESC']);

        /* Render */
        return $this->render('pages/play/play_chapter.html.twig', compact('ennemies'));
    }
}