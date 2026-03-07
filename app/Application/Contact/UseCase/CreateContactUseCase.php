<?php

namespace Application\Contact\UseCase;

use Application\Contact\DTO\ContactCreateDTO;
use Domain\Contact\Entities\Contact;
use Domain\Contact\Services\ContactService;

class CreateContactUseCase
{
    public function __construct(
        private ContactService $contactService
    ) {
        $this->contactService = $contactService;
    }

    public function execute(ContactCreateDTO $dto): Contact
    {
        $contact = new Contact(
            uniqid(),
            $dto->name,
            $dto->email,
            $dto->phone
        );

        return $this->contactService->createContact($contact);
    }
}
