<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\GatahRequestResource;
use App\Models\Balance;
use App\Models\Gatah;
use App\Models\GatahRequest;
use Illuminate\Http\Request;

class GatahRequestController extends Controller
{

    public function index()
    {
        return response()->json([
            'data' => GatahRequestResource::collection(GatahRequest::all())
        ]);
    }


    public function approve_gatah(Gatah $gatah, Request $request)
    {

        if ($gatah->is_paid == 1) {
            return response()->json([
                'message' => 'the gatah already approved!!',
                'data' =>  GatahRequestResource::collection(GatahRequest::find($gatah->request))
            ]);
        }

        $gatah->update([
            'is_paid' => 1,
        ]);

        GatahRequest::find($gatah->request->id)->update(['status' => 1]);

        $amount = $gatah->user->id == 3 ? 100 : 150;

        $pastBalance = Balance::latest()->first()->balance;
        $currentBalance = $amount + $pastBalance;
        Balance::create([
            'balance' => $currentBalance,
            'added' => $amount,
            'discription' => 'قطة'
        ]);

        return response()->json([
            'message' => 'gatah updated seccussfully!',
            'data' => $gatah
        ]);
    }
}
