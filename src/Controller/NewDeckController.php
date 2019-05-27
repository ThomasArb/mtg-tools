<?php

namespace App\Controller;

use App\Entity\Deck;
use App\Form\DeckType;
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

class NewDeckController
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
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * NewDeckController constructor.
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
      $this->entitymanager = $registry->getManagerForClass(Deck::class);
      $this->templatingEngine = $templatingEngine;
      $this->router = $router;
      $this->formFactory = $formFactory;

    }

    /**
     * @Route("/decks/new", name="new_deck")
     * @param Request $request
     * @return Response
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function index(Request $request): Response
    {
        $deck = new Deck();
        $form = $this->formFactory->create(DeckType::class, $deck);
        $form->handleRequest($request);
        if ( $form->isSubmitted() && $form->isValid()) {
            $this->entitymanager->persist($deck);
            $this->entitymanager->flush();
        }
        return new Response($this->templatingEngine->render('new_deck/index.html.twig', [
            'form' => $form->createView(),
        ]));
    }
}
