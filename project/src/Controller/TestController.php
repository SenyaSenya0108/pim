<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    #[Route('/api/test', methods: ["GET"])]
    public function index(): Response
    {
        return new Response("PID: " . getmypid() . "\n");
    }
}
