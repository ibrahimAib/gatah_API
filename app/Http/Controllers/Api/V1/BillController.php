<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Bill;
use App\Http\Requests\StoreBillRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\BillResource;
use App\Models\BillRequest;
use App\Models\Perchese;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BillResource::collection(Bill::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBillRequest $request)
    {
        // $price = 0;
        $items = [];
        $bill = Bill::create([
            'user_id' => Auth::id(),         // this is tumprery!! 
            'total' => 0,
            'is_paid' => 2
        ]);
        $bill_total = 0;
        foreach ($request->items as $item) {
            $bill_total += $item['price'];
            $items[] = [
                'bill_id' => $bill->id,
                'user_id' => $bill->user_id,
                'title' => $item['title'],
                'price' => $item['price'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Perchese::insert($items);
        $bill->update([
            'total' => $bill_total
        ]);
        BillRequest::create([
            'user_id' => Auth::id(),
            'bill_id' => $bill->id,
            'price' => $bill_total,
        ]);


        return response()->json([
            'message' => 'bill add succssfuly',
        ], 200);
    }

    public function delete($id)
    {
        $bill = Bill::find($id);

        if (!$bill) {
            return response()->json([
                'message' => "The bill was deleted or doesn't exist"
            ], 404);
        }
        if ($bill->user->id != Auth::id()) {
            return response()->json([
                'message' => 'unAuthorized',
                'data' => new BillResource($bill)
            ], 403);
        }

        if ($bill->is_paid == 1) {
            return response()->json([
                'message' => 'the bill is already paid!',
                'data' => new BillResource($bill)
            ]);
        }

        DB::transaction(function () use ($bill) {
            $bill->request->delete();
            $bill->delete();
        });

        return response()->json([
            'message' => 'bill deleted successfully',
            'data' => new BillResource($bill)
        ]);
    }
}
