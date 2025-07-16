<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'bill_id' => $this->id,
            'user_name' => $this->user->name,
            'bill_total' => $this->total,
            'is_paid' => $this->is_paid == '1' ? 'paid' : 'review',
            'percheses' => PercheseResource::collection($this->percheses->all()),
            'is_deleteable' => Auth::id() == $this->user->id ? true : false,
            '$this->user->id' => $this->user->id,
            'Auth::id()' => Auth::id()

        ];
    }
}
