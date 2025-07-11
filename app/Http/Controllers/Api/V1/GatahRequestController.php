<?php

namespace App\Http\Controllers;

use App\Models\GatahRequest;
use Illuminate\Http\Request;

class GatahRequestController extends Controller
{
    public function store($user_id, $gatah_id, $price)
    {
        GatahRequest::create([
            'user_id' => $user_id,
            'gatah_id' => $gatah_id,
            'price' => $price,
        ]);
    }
}
