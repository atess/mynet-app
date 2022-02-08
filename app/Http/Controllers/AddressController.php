<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\AddressRepositoryInterface;
use App\Http\Requests\Address\IndexAddressRequest;
use App\Http\Requests\Address\StoreAddressRequest;
use App\Http\Requests\Address\UpdateAddressRequest;
use App\Http\Resources\Address\AddressCollection;
use App\Http\Resources\Address\AddressResource;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    use ApiResponse;

    protected AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $repository)
    {
        $this->addressRepository = $repository;
    }

    /**
     * Kisiye ait adres listesi sayfalandirilarak donduruluyor.
     *
     * @param IndexAddressRequest $request
     * @return JsonResponse
     */
    public function index(IndexAddressRequest $request): JsonResponse
    {
        $validated = $request->validated();

        return $this->success(
            new AddressCollection(
                $this->addressRepository->paginate(10, [
                    'person_id' => $validated['person_id']
                ])
            )
        );
    }

    /**
     * Kisiye yeni bir adres ekleniyor.
     *
     * @param StoreAddressRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(StoreAddressRequest $request): JsonResponse
    {
        $validated = $request->validated();

        return $this->success(
            new AddressResource(
                $this->addressRepository->create($validated)
            ),
            __('address.created'),
            201
        );
    }

    /**
     * Ilgili adres dondurulur.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->success(
            new AddressResource(
                $this->addressRepository->find($id)
            )
        );
    }

    /**
     * Ilgili adres guncellenir.
     *
     * @param UpdateAddressRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function update(UpdateAddressRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();

        return $this->success(
            new AddressResource(
                $this->addressRepository->update($validated, $id)
            ),
            __('address.updated')
        );
    }

    /**
     * Ilgili adres silinir.
     *
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(int $id): JsonResponse
    {
        $this->addressRepository->destroy($id);

        return $this->success(
            null,
            __('address.deleted')
        );
    }
}
