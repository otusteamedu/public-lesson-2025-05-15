<?php

namespace App\Controller\UpdateTranslatableMessage;

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

    #[Route(path: '/api/v1/update-translatable-message/{id}', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function __invoke(int $id, #[MapRequestPayload] InputDTO $dto): Response
    {
        return $this->messageService->updateTranslatableMessage($id, $dto->message, $dto->locale) ?
            new JsonResponse(['success' => true], Response::HTTP_OK) :
            new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }
}
