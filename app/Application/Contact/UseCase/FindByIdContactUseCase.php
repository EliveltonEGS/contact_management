<?php

namespace Application\Contact\UseCase;

use Domain\Contact\Entities\Contact;
use Domain\Contact\Services\ContactService;

class FindByIdContactUseCase
{
    public function __construct(
        private ContactService $contactService
    ) {}

    public function execute(string $id): ?Contact
    {
        return $this->contactService->show($id);
    }
}
