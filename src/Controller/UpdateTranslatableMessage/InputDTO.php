<?php

namespace App\Controller\UpdateTranslatableMessage;

readonly final class InputDTO
{
    public function __construct(public string $locale, public string $message) {
    }
}
