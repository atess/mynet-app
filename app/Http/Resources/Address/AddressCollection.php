<?php

namespace App\Http\Resources\Address;

use App\Http\Resources\PaginationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AddressCollection extends ResourceCollection
{
    public $pagination;

    public function __construct($resource)
    {
        $this->pagination = new PaginationResource($resource);
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'list' => AddressResource::collection($this->collection),
            'pagination' => $this->pagination,
        ];
    }
}
