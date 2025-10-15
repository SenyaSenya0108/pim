<?php

namespace App\Order\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Common\Service\UserServiceInterface;
use App\Order\Entity\Order;
use App\Order\Repository\OrderRepository;

class OrderUserProvider implements ProviderInterface
{
    public function __construct(private OrderRepository $orderRepository, private UserServiceInterface $userService){

    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        /** @var Order $orderData */
        $orderData = $this->orderRepository->find($uriVariables['id']);
        $userData = $this->userService->getOrderUser($orderData->getUserId());

        return $userData;
    }
}
