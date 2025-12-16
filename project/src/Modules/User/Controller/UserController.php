<?php

declare(strict_types=1);

namespace App\Modules\User\Controller;

use App\Modules\User\Service\UserService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[AsController]
class UserController extends AbstractController
{
    public function __construct(private readonly UserService $userService, private readonly LoggerInterface $logger)
    {
    }

    #[IsGranted("ROLE_ADMIN")]
    #[Route("/users", name: "users.all", methods: ["GET"], format: "json")]
    public function getAll(): Response
    {
        try {
            $users = $this->userService->getAll();
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage());
            return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(json_encode($users), Response::HTTP_OK);
    }
}
