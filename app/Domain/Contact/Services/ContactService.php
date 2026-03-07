<?php

namespace Domain\Contact\Services;

use Domain\Contact\Entities\Contact;
use Domain\Contact\Repositories\ContactRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ContactService
{
    public function __construct(
        private ContactRepositoryInterface $contactRepository
    ) {
        $this->contactRepository = $contactRepository;
    }

    public function store(Contact $contact): Contact
    {
        $this->contactRepository->store($contact);
        return $contact;
    }

    public function show(string $id): ?Contact
    {
        return $this->contactRepository->show($id);
    }

    public function all(): Collection
    {
        return $this->contactRepository->all();
    }
}
