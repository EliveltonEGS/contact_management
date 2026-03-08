<?php

namespace Application\Contact\UseCase;

use Domain\Contact\Services\ContactService;

class DestroyContactUseCase
{
    public function __construct(
        private ContactService $contactService
    ) {}

    public function execute(string $id): bool
    {
        return $this->contactService->destroy($id);
    }
}
