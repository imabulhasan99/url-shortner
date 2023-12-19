<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UrlResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'fullurl'   => $this->resource['fullurl'],
            'shorturl'  => $this->resource['shorturl'],
            'views'     => $this->resource['views'],
        ];
    }
}
