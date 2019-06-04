<?php

namespace App\Controller;

use App\Entity\Game;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

class ListGameController
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var EngineInterface
     */
    private $templatingEngine;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * ListGameController constructor.
     * @param RegistryInterface $registry
     * @param EngineInterface $templatingEngine
     * @param UrlGeneratorInterface $router
     */
    public function __construct(
        RegistryInterface $registry,
        EngineInterface $templatingEngine,
        UrlGeneratorInterface $router
    ) {
      $this->entityManager = $registry->getManagerForClass(Game::class);
      $this->templatingEngine = $templatingEngine;
      $this->router = $router;

    }

    /**
     * @Route("/games", name="list_game")
     * @return Response
     */
    public function index(): Response
    {
        return new Response($this->templatingEngine->render('list_game/index.html.twig', [
            'games' => $this->entityManager->getRepository(Game::class)->findAll(),
        ]));
    }
}
