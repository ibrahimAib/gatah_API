<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GatahRequestResource extends JsonResource
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
            'gatah_id' => $this->gatah->id,
            'created_at' => $this->created_at,
            'user_name' => $this->user->name,
            'price' => $this->price,
            'status' => $this->status == '1' ? 'approved' : 'review',
        ];
    }
}
