<?php

namespace App\Controller\StaticTranslate;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[AsController]
readonly final class Controller
{
    public function __construct(private TranslatorInterface $translator)
    {
    }

    #[Route(path: '/api/v1/{_locale}/translate', requirements: ['_locale' => 'en|ru'], methods: ['GET'])]
    public function __invoke(
        #[MapQueryParameter] string $message,
        #[MapQueryParameter] ?string $name = null,
        #[MapQueryParameter] ?string $gender = null,
        #[MapQueryParameter] ?int $mushrooms = null
    ): Response {
        return new JsonResponse(
            [
                'message' => ($name === null && $gender === null && $mushrooms === null) ?
                    $this->translator->trans($message) :
                    $this->translator->trans(
                        $message,
                        ['name' => $name, 'gender' => $gender, 'mushrooms' => $mushrooms],
                    ),
                ],
            Response::HTTP_OK
        );
    }
}
