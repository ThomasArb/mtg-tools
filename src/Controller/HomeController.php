<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

class HomeController
{

    /**
     * @var EngineInterface
     */
    private $templatingEngine;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * HomeController constructor.
     * @param EngineInterface $templatingEngine
     * @param UrlGeneratorInterface $router
     */
    public function __construct(
        EngineInterface $templatingEngine,
        UrlGeneratorInterface $router
    ) {
        $this->templatingEngine = $templatingEngine;
        $this->router = $router;

    }

    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(): Response
    {
        return new Response($this->templatingEngine->render('home/home.html.twig'));
    }
}
