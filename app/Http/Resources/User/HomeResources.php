<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $pagination = null;

        if ($this->resource instanceof \Illuminate\Pagination\AbstractPaginator) {
            $pagination = [
                'total' => $this->resource->total(),
                'per_page' => $this->resource->perPage(),
                'current_page' => $this->resource->currentPage(),
                'last_page' => $this->resource->lastPage(),
                'from' => $this->resource->firstItem(),
                'to' => $this->resource->lastItem(),
            ];
        }

        return [
            'data' => [
                'id' => $this->id,
                'description' => $this->description,
            ],
            'pagination' => $pagination,
        ];
    }
}
