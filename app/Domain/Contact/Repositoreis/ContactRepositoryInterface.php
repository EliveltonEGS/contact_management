<?php

namespace Domain\Contact\Repositoreis;

use Domain\Contact\Entities\Contact;

interface ContactRepositoryInterface
{
    public function save(Contact $contact): void;
    public function find(string $id): ?Contact;
}
