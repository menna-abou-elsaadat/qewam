<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\InvoiceUserSessionResource;

class InvoiceUserResource extends JsonResource
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
            'user' => $this->user_id,
            'sessions' => InvoiceUserSessionResource::collection($this->invoiceSessions)
        ];
    }
}
