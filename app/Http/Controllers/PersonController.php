<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\PersonRepositoryInterface;
use App\Http\Requests\Person\StorePersonRequest;
use App\Http\Requests\Person\UpdatePersonRequest;
use App\Http\Resources\Person\PersonCollection;
use App\Http\Resources\Person\PersonResource;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;

class PersonController extends Controller
{
    use ApiResponse;

    protected $personRepository;

    public function __construct(PersonRepositoryInterface $repository)
    {
        $this->personRepository = $repository;
    }

    /**
     * Kisi listesi sayfalandirilarak donduruluyor.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success(
            new PersonCollection(
                $this->personRepository->paginate(10)
            )
        );
    }

    /**
     * Yeni bir kisi ekleniyor.
     *
     * @param StorePersonRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(StorePersonRequest $request): JsonResponse
    {
        $validated = $request->validated();

        return $this->success(
            new PersonResource(
                $this->personRepository->create($validated)
            ),
            __('person.created'),
            201
        );
    }

    /**
     * Ilgili kisi donduruluyor.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->success(
            new PersonResource(
                $this->personRepository->find($id)
            )
        );
    }

    /**
     * Ilgili kisi guncelleniyor.
     *
     * @param UpdatePersonRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function update(UpdatePersonRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();

        return $this->success(
            new PersonResource(
                $this->personRepository->update($validated, $id)
            ),
            __('person.updated')
        );
    }

    /**
     * Ilgili kisi siliniyor.
     *
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(int $id): JsonResponse
    {
        $this->personRepository->destroy($id);

        return $this->success(
            null,
            __('person.deleted')
        );
    }
}
