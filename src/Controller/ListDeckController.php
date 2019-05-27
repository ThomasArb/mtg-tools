<?php

namespace App\Controller;

use App\Entity\Deck;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

class ListDeckController
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
     * ListDeckController constructor.
     * @param RegistryInterface $registry
     * @param EngineInterface $templatingEngine
     * @param UrlGeneratorInterface $router
     */
    public function __construct(
        RegistryInterface $registry,
        EngineInterface $templatingEngine,
        UrlGeneratorInterface $router
    ) {
      $this->entitymanager = $registry->getManagerForClass(Deck::class);
      $this->templatingEngine = $templatingEngine;
      $this->router = $router;

    }

    /**
     * @Route("/decks", name="list_deck")
     * @return Response
     */
    public function index(): Response
    {
        return new Response($this->templatingEngine->render('list_deck/index.html.twig', [
            'decks' => $this->entitymanager->getRepository(Deck::class)->findAll(),
        ]));
    }
}
