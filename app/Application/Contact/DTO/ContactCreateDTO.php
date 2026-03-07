<?php

namespace Application\Contact\DTO;

class ContactCreateDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone
    ) {}

    public static function makeFromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            phone: $data['phone']
        );
    }
}
