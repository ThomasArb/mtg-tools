<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BasicController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        return new Response('Work in progress');
    }
}
