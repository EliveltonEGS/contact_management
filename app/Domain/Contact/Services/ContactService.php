<?php

namespace Domain\Contact\Services;

use Domain\Contact\Entities\Contact;
use Domain\Contact\Repositoreis\ContactRepositoryInterface;

class ContactService
{
    public function __construct(
        private ContactRepositoryInterface $contactRepository
    ) {
        $this->contactRepository = $contactRepository;
    }

    public function createContact(Contact $contact): Contact
    {
        $this->contactRepository->save($contact);
        return $contact;
    }
}
