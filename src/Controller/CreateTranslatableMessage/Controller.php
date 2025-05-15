<?php

namespace App\Controller\CreateTranslatableMessage;

use App\Service\MessageService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
readonly final class Controller
{
    public function __construct(private MessageService $messageService)
    {
    }

    #[Route(path: '/api/v1/create-message', methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] InputDTO $dto): Response
    {
        $result = $this->messageService->createTranslatableMessage($dto->message, $dto->locale);

        return new JsonResponse(['id' => $result->getId()], Response::HTTP_OK);
    }
}
