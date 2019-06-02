<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\PlayerType;
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

class NewPlayerController
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
     * NewPlayerController constructor.
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
        $this->entityManager = $registry->getManagerForClass(Player::class);
        $this->templatingEngine = $templatingEngine;
        $this->router = $router;
        $this->formFactory = $formFactory;

    }

    /**
     * @Route("/players/new", name="new_player")
     * @param Request $request
     * @return Response
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function index(Request $request): Response
    {
        $player = new Player();
        $form = $this->formFactory->create(PlayerType::class, $player);
        $form->handleRequest($request);
        if ( $form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($player);
            $this->entityManager->flush();
        }
        return new Response($this->templatingEngine->render('new_player/index.html.twig', [
            'form' => $form->createView(),
        ]));
    }
}
