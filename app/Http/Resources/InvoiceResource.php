<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\InvoiceUserResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return 
        [
            'starting_date' => $this->starting_date,
            'ending_date' => $this->ending_date,
            'total_price' => $this->totalPrice(),
            'users' => InvoiceUserResource::collection($this->users),
        ];
    }
}
