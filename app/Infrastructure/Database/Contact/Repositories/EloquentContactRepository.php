<?php

namespace Infrastructure\Database\Contact\Repositories;

use App\Models\Contact as EloquentContact;
use Domain\Contact\Entities\Contact;
use Domain\Contact\Repositoreis\ContactRepositoryInterface;

class EloquentContactRepository implements ContactRepositoryInterface
{
    public function save(Contact $contact): void
    {
        EloquentContact::updateOrCreate(
            ['id' => $contact->getId()],
            [
                'name' => $contact->getName(),
                'email' => $contact->getEmail(),
                'phone' => $contact->getPhone(),
            ]
        );
    }

    public function find(string $id): ?Contact
    {
        $eloquentContact = EloquentContact::find($id);
        if (!$eloquentContact) {
            return null;
        }

        return new Contact(
            $eloquentContact->id,
            $eloquentContact->name,
            $eloquentContact->email,
            $eloquentContact->phone
        );
    }
}
