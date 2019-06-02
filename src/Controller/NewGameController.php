<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\PlayerDeckLink;
use App\Form\GameType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

class NewGameController
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
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * NewGameController constructor.
     * @param RegistryInterface $registry
     * @param EngineInterface $templatingEngine
     * @param UrlGeneratorInterface $router
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(
        RegistryInterface $registry,
        EngineInterface $templatingEngine,
        UrlGeneratorInterface $router,
        FormFactoryInterface $formFactory
    ) {
      $this->entityManager = $registry->getManagerForClass(Game::class);
      $this->templatingEngine = $templatingEngine;
      $this->router = $router;
      $this->formFactory = $formFactory;

    }

    /**
     * @Route("/games/new", name="new_game")
     * @param Request $request
     * @return Response
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function index(Request $request): Response
    {
        $game = new Game();
        for ($i = 0; $i < 4; ++$i) {
            $game->addPlayerDeckLinks(new PlayerDeckLink());
        }
        $form = $this->formFactory->create(GameType::class, $game);
        $form->handleRequest($request);
        if ( $form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($game);
            $this->entityManager->flush();
        }
        return new Response($this->templatingEngine->render('new_game/index.html.twig', [
            'form' => $form->createView(),
        ]));
    }
}
