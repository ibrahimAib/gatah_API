<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BillRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'bill_id' => $this->bill->id,
            'user_name' => $this->user->name,
            'price' => $this->price,
            'status' => $this->status == '1' ? 'approved' : 'review',
            'created_at' => $this->created_at,
            'bill' => $this->bill->percheses,
        ];
    }
}
