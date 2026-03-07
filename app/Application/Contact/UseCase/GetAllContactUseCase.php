<?php

namespace Application\Contact\UseCase;

use Domain\Contact\Entities\Contact;
use Domain\Contact\Services\ContactService;

class GetAllContactUseCase
{
    public function __construct(
        private ContactService $contactService
    ) {}

    /**
     * @return Contact[]
     */
    public function execute(): array
    {
        return $this->contactService->all();
    }
}
