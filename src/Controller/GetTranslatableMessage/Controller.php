<?php

namespace App\Controller\GetTranslatableMessage;

use App\Controller\CreateTranslatableMessage\InputDTO;
use App\Service\MessageService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Service\Attribute\Required;

#[AsController]
readonly final class Controller
{
    public function __construct(private MessageService $messageService)
    {
    }

    #[Route(path: '/api/v1/get-message/{id}', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function __invoke(int $id, #[MapQueryParameter]?string $locale = null, #[MapQueryParameter]?bool $fallback = false): Response
    {
        $result = $this->messageService->getTranslatableMessage($id, $locale, $fallback);

        return $result === null ? new JsonResponse(null, Response::HTTP_NOT_FOUND) :
            new JsonResponse(['id' => $result->getId(), 'message' => $result->getMessage()], Response::HTTP_OK);
    }
}
