<?php

declare(strict_types=1);

namespace App\Modules\User\Controller;

use App\Modules\User\DTO\UserRegistrationDTO;
use App\Modules\User\Service\UserService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class SecurityController extends AbstractController
{
    public function __construct(private readonly LoggerInterface $logger, private readonly UserService $userService)
    {
    }

    #[Route('/register', name: 'auth.register', methods: ['POST'], format: 'json')]
    public function register(
        #[MapRequestPayload(
            validationFailedStatusCode: Response::HTTP_UNPROCESSABLE_ENTITY
        )] UserRegistrationDTO $userDto
    ): Response
    {
        $this->logger->info("user registration started");
        try {
            $this->userService->create($userDto);
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
            return new JsonResponse(["error" => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['response' => 'success'], Response::HTTP_OK);
    }
}
