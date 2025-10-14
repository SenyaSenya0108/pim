<?php

namespace App\User\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    #[Route('/api/user_test', methods: ["GET"])]
    public function index(): Response
    {
        return new Response("the user module");
    }
}
