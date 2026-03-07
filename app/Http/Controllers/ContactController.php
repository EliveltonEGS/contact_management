<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\ContactRequest;
use Application\Contact\DTO\ContactCreateDTO;
use Application\Contact\UseCase\CreateContactUseCase;
use Illuminate\Http\JsonResponse;

#http://localhost:8080/api/documentation

/**
 * @OA\Info(
 *     title="API of Contacts",
 *     version="1.0"
 * )
 */
class ContactController extends Controller
{
    public function __construct(
        private CreateContactUseCase $createContactUseCase
    ) {}

    /**
     * @OA\Post(
     *     path="/api/contacts",
     *     summary="New Contact",
     *     tags={"Contacts"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email", "phone"},
     *             @OA\Property(property="name", type="string", example="João"),
     *             @OA\Property(property="email", type="string", example="joao@email.com"),
     *             @OA\Property(property="phone", type="string", example="119999999")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created"
     *     )
     * )
     */
    public function store(ContactRequest $request): JsonResponse
    {
        $dto = ContactCreateDTO::makeFromRequest($request->validated());
        $contact = $this->createContactUseCase->execute($dto);

        return response()->json($contact->toArray(), 201);
    }
}
