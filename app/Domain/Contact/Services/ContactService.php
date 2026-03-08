<?php

namespace Domain\Contact\Services;

use Domain\Contact\Entities\Contact;
use Domain\Contact\Repositories\ContactRepositoryInterface;

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

    public function upate(Contact $contact): ?Contact
    {
        $this->contactRepository->update($contact);
        return $contact;
    }

    public function show(string $id): ?Contact
    {
        return $this->contactRepository->show($id);
    }

    /**
     * Method all
     *
     * @return Contact[]
     */
    public function all(): array
    {
        return $this->contactRepository->all();
    }

    public function destroy(string $id): bool
    {
        return $this->contactRepository->destroy($id);
    }
}
