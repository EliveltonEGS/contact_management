<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactCreateRequest;
use App\Http\Requests\Contact\ContactUpdateRequest;
use Application\Contact\DTO\ContactCreateDTO;
use Application\Contact\DTO\ContactUpdateDTO;
use Application\Contact\UseCase\CreateContactUseCase;
use Application\Contact\UseCase\DestroyContactUseCase;
use Application\Contact\UseCase\FindByIdContactUseCase;
use Application\Contact\UseCase\GetAllContactUseCase;
use Application\Contact\UseCase\UpdateContactUseCase;
use Illuminate\Http\JsonResponse;

#http://localhost:8080/api/documentation

/**
 * @OA\Info(
 *     title="API Contacts",
 *     version="1.0"
 * )
 */
class ContactController extends Controller
{
    public function __construct(
        private CreateContactUseCase $createContactUseCase,
        private FindByIdContactUseCase $findByIdContactUseCase,
        private GetAllContactUseCase $getAllContactUseCase,
        private DestroyContactUseCase $destroyContactUseCase,
        private UpdateContactUseCase $updateContactUseCase
    ) {}

    /**
     * @OA\Post(
     *     path="/api/contacts",
     *     summary="New Contact",
     *     tags={"Contacts Create"},
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
    public function store(ContactCreateRequest $request): JsonResponse
    {
        $dto = ContactCreateDTO::makeFromRequest($request->validated());
        $contact = $this->createContactUseCase->execute($dto);

        return response()->json($contact->toArray(), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/contacts/{id}",
     *     summary="Find by ID",
     *     description="Return contact",
     *     tags={"Contact find"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID contact",
     *         required=true,
     *         @OA\Schema(type="string", example="69ab85ce68ca5")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Contact found",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="string", example="69ab85ce68ca5"),
     *             @OA\Property(property="name", type="string", example="João Silva"),
     *             @OA\Property(property="email", type="string", example="joao@email.com"),
     *             @OA\Property(property="phone", type="string", example="11999999999")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Contato não encontrado"
     *     )
     * )
     */
    public function show(string $id): JsonResponse
    {
        $contact = $this->findByIdContactUseCase->execute($id);

        if (!$contact) {
            return response()->json(['message' => 'Contact not found'], 404);
        }

        return response()->json($contact->toArray());
    }

    /**
     * @OA\Get(
     *     path="/api/contacts",
     *     summary="Get All contacts",
     *     description="Return all contacts",
     *     tags={"Contact all"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Contact found",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="string", example="69ab85ce68ca5"),
     *             @OA\Property(property="name", type="string", example="João Silva"),
     *             @OA\Property(property="email", type="string", example="joao@email.com"),
     *             @OA\Property(property="phone", type="string", example="11999999999")
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $data = $this->getAllContactUseCase->execute();
        return response()->json($data, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/contacts/{id}",
     *     summary="Delete by ID",
     *     description="Delete contact",
     *     tags={"Delete contact"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Destroy contact",
     *         required=true,
     *         @OA\Schema(type="string", example="69ab85ce68ca5")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Contact not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Contact deleted")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Contact not found"
     *     )
     * )
     */
    public function destroy(string $id): JsonResponse
    {
        $contact = $this->destroyContactUseCase->execute($id);
        if (!$contact) {
            return response()->json(['message' => 'Contact not found'], 404);
        }

        return response()->json(['message' => 'Contact deleted'], 204);
    }

    /**
     * @OA\Put(
     *     path="/api/contacts/{id}",
     *     summary="Update by ID",
     *     description="Update contact",
     *     tags={"Upate find"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Update contact",
     *         required=true,
     *         @OA\Schema(type="string", example="69ab85ce68ca5")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Update contact",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="string", example="69ab85ce68ca5"),
     *             @OA\Property(property="name", type="string", example="João Silva"),
     *             @OA\Property(property="email", type="string", example="joao@email.com"),
     *             @OA\Property(property="phone", type="string", example="11999999999")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Contato não encontrado"
     *     )
     * )
     */
    public function update(ContactUpdateRequest $request, $id): JsonResponse
    {
        $dto = ContactUpdateDTO::makeFromRequest($request->validated(), $id);
        $contact = $this->updateContactUseCase->execute($dto);

        return response()->json($contact->toArray(), 201);
    }
}
