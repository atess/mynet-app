<?php

namespace App\Http\Resources\Person;

use App\Http\Resources\PaginationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PersonCollection extends ResourceCollection
{
    public PaginationResource $pagination;

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
            'list' => PersonResource::collection($this->collection),
            'pagination' => $this->pagination,
        ];
    }
}
