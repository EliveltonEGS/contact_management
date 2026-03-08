<?php

namespace Infrastructure\Database\Contact\Repositories;

use App\Models\Contact as EloquentContact;
use Domain\Contact\Entities\Contact;
use Domain\Contact\Repositories\ContactRepositoryInterface;

class EloquentContactRepository implements ContactRepositoryInterface
{
    public function store(Contact $contact): void
    {
        EloquentContact::create(
            [
                'id' => $contact->getId(),
                'name' => $contact->getName(),
                'email' => $contact->getEmail(),
                'phone' => $contact->getPhone(),
            ]
        );
    }

    public function update(Contact $contact): ?Contact
    {
        $eloquentContact = EloquentContact::findOrFail($contact->getId());

        if (!$eloquentContact) {
            return null;
        }

        $eloquentContact->update(
            [
                'name' => $contact->getName(),
                'email' => $contact->getEmail(),
                'phone' => $contact->getPhone(),
            ]
        );

        return new Contact(
            $eloquentContact->id,
            $eloquentContact->name,
            $eloquentContact->email,
            $eloquentContact->phone
        );
    }

    public function show(string $id): ?Contact
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

    /**
     * Method all
     *
     * @return Contact[]
     */
    public function all(): array
    {
        return EloquentContact::all()->toArray();
    }

    public function destroy(string $id): bool
    {
        $eloquentContact = EloquentContact::find($id);
        if (!$eloquentContact) {
            return false;
        }

        return EloquentContact::destroy($id);
    }
}
