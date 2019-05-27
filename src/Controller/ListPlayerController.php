<?php

namespace App\Controller;

use App\Entity\Player;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

class ListPlayerController
{
    /**
     * @var EntityManager
     */
    private $entitymanager;

    /**
     * @var EngineInterface
     */
    private $templatingEngine;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * ListPlayerController constructor.
     * @param RegistryInterface $registry
     * @param EngineInterface $templatingEngine
     * @param UrlGeneratorInterface $router
     */
    public function __construct(
        RegistryInterface $registry,
        EngineInterface $templatingEngine,
        UrlGeneratorInterface $router
    ) {
        $this->entitymanager = $registry->getManagerForClass(Player::class);
        $this->templatingEngine = $templatingEngine;
        $this->router = $router;

    }

    /**
     * @Route("/players", name="list_player")
     * @return Response
     */
    public function index(): Response
    {
        return new Response($this->templatingEngine->render('list_player/index.html.twig', [
            'players' => $this->entitymanager->getRepository(Player::class)->findAll(),
        ]));
    }
}
