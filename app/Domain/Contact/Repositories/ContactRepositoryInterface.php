<?php

namespace Domain\Contact\Repositories;

use Domain\Contact\Entities\Contact;

interface ContactRepositoryInterface
{
    public function store(Contact $contact): void;
    public function show(string $id): ?Contact;
    /**
     * Method all
     *
     * @return Contact[]
     */
    public function all(): array;
}
