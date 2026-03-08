<?php

namespace Application\Contact\DTO;

class ContactUpdateDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone
    ) {}

    public static function makeFromRequest(array $data, string $id): self
    {
        return new self(
            id: $id,
            name: $data['name'],
            email: $data['email'],
            phone: $data['phone']
        );
    }
}
