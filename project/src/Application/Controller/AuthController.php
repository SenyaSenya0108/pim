<?php

declare(strict_types=1);

namespace App\Application\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class AuthController extends AbstractController
{
    public function __construct(private LoggerInterface $logger)
    {

    }

    #[Route('/register', name: 'auth.register', methods: ['POST'])]
    public function register(): RedirectResponse
    {
        $this->logger->info("user registration started");

        return $this->redirectToRoute('login', parameters: [], status: 307);
    }

    #[Route('/login', name: 'login', methods: ['POST'])]
    public function login(): Response
    {

        return new Response();
    }
}
