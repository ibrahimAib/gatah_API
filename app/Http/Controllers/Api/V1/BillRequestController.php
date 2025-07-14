<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BillRequestResource;
use App\Models\Balance;
use App\Models\Bill;
use App\Models\BillRequest;
use Illuminate\Http\Request;

class BillRequestController extends Controller
{
    public function index()
    {
        return BillRequestResource::collection(BillRequest::all());
    }
    public function bill_paid(Bill $bill, Request $request)
    {
        if ($bill->is_paid == 1) {
            return response()->json([
                'message' => 'the bill already paid!!',
                'data' => $bill
            ]);
        }


        $bill->update([
            'is_paid' => 1,
        ]);
        BillRequest::find($bill->request->id)->update(['status' => 1]);

        $amount = $bill->total;

        $pastBalance = Balance::latest()->first()->balance;
        $currentBalance =  $pastBalance - $amount;

        Balance::create([
            'balance' => $currentBalance,
            'spent' => $amount,
            'discription' => 'فاتورة'
        ]);

        return response()->json([
            'message' => 'bill updated seccussfully!',
            'data' => $bill
        ]);
    }
}
