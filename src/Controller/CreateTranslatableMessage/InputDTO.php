<?php

namespace App\Controller\CreateTranslatableMessage;

readonly final class InputDTO
{
    public function __construct(public string $locale, public string $message) {
    }
}
