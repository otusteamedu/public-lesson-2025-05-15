<?php

namespace App\Service;

use App\Entity\TranslatableMessage;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Translatable\TranslatableListener;

readonly final class MessageService
{
    private const DEFAULT_LOCALE = 'en_US';

    public function __construct(
        private EntityManagerInterface $entityManager,
        private TranslatableListener $translatableListener
    ) {
    }

    public function createTranslatableMessage(string $message, string $locale): TranslatableMessage
    {
        $result = new TranslatableMessage();
        $result->setMessage($message);
        $result->setLocale($locale);
        $this->entityManager->persist($result);
        $this->entityManager->flush();

        return $result;
    }

    public function getTranslatableMessage(int $id, ?string $locale, ?bool $fallback = false): ?TranslatableMessage
    {
        $repository = $this->entityManager->getRepository(TranslatableMessage::class);
        $message = $repository->find($id);
        if ($message === null) {
            return null;
        }

        if ($locale !== null && $locale !== self::DEFAULT_LOCALE) {
            $this->translatableListener->setTranslationFallback($fallback);
            $message->setLocale($locale);
            $this->entityManager->refresh($message);
        }

        return $message;
    }

    public function updateTranslatableMessage(int $id, string $message, string $locale): bool
    {
        $repository = $this->entityManager->getRepository(TranslatableMessage::class);
        $translatableMessage = $repository->find($id);
        if ($translatableMessage === null) {
            return false;
        }

        $translatableMessage->setLocale($locale);
        $translatableMessage->setMessage($message);
        $this->entityManager->flush();

        return true;
    }
}
