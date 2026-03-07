<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\ContactRequest;
use Application\Contact\DTO\ContactCreateDTO;
use Application\Contact\UseCase\CreateContactUseCase;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function __construct(
        private CreateContactUseCase $createContactUseCase
    ) {}

    public function store(ContactRequest $request): JsonResponse
    {
        $dto = ContactCreateDTO::makeFromRequest($request->validated());
        $contact = $this->createContactUseCase->execute($dto);

        return response()->json($contact->toArray(), 201);
    }
}
