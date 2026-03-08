<?php

namespace Application\Contact\UseCase;

use Application\Contact\DTO\ContactUpdateDTO;
use Domain\Contact\Entities\Contact;
use Domain\Contact\Services\ContactService;

class UpdateContactUseCase
{
    public function __construct(
        private ContactService $contactService
    ) {
        $this->contactService = $contactService;
    }

    public function execute(ContactUpdateDTO $dto): ?Contact
    {
        $contact = new Contact(
            $dto->id,
            $dto->name,
            $dto->email,
            $dto->phone
        );

        return $this->contactService->upate($contact);
    }
}
