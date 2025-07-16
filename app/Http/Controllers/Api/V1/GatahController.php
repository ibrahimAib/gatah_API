<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Gatah;
use App\Http\Requests\StoreGatahRequest;
use App\Http\Requests\UpdateGatahRequest;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\GatahRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GatahController extends Controller
{
    public function past(Request $request)
    {
        $current_month = $request->query('date'); // gets ?date=2025/6
        if (!$current_month) {
            return response()->json(['error' => 'No date provided'], 400);
        }

        $last_month = substr($current_month, 0, 4) . '-' . '0' . $current_month[-1] - 1;
        $users = User::all();
        $gatahList = [];
        // $gatahData = Gatah::pluck('date')->unique()->values()->all();
        $gatahData = Gatah::select('date')
            ->whereNotIn('date', [$current_month, $last_month])
            ->distinct()
            ->pluck('date');

        $gatahs = Gatah::whereIn('date', $gatahData)
            ->get();

        foreach ($gatahData as $month) {
            $monthGatah = Gatah::where('date', 'like', "$month%")->get();

            $userIds = array_column($monthGatah->toArray(), 'user_id');
            if ($month != $current_month && $month != $last_month) {
                foreach ($users as $user) {
                    $index = array_search($user->id, $userIds);
                    if (!in_array($user->id, $userIds)) {
                        $gatahList[] = [
                            'user_id' => $user->id,
                            'name' => $user->name,
                            'phone' => $user->phone,
                            'isPaid' =>  'unpaid',
                            'date' => $month
                        ];
                    } elseif ($monthGatah[$index]->is_paid == 2) {
                        $gatahList[] = [
                            'user_id' => $user->id,
                            'name' => $user->name,
                            'phone' => $user->phone,
                            'isPaid' =>  'review',
                            'gatah_id' => $monthGatah[$index]->id,
                            'date' => $month
                        ];
                    }
                }
            }
        }


        return response()->json([
            'data' => $gatahList
        ]);
    }


    public function store(StoreGatahRequest $request)
    {
        $newGatah = Gatah::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'is_paid' => 2
        ]);
        $amount = Auth::id() == 3 ? 100 : 150;


        GatahRequest::create([
            'user_id' => Auth::id(),
            'gatah_id' => $newGatah->id,
            'price' => $amount,
        ]);
        return response()->json([
            'message' => 'added sucssecfuly',
            'data' => $newGatah
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $date = $request->query('date'); // gets ?date=2025/6
        if (!$date) {
            return response()->json(['error' => 'No date provided'], 400);
        }

        // match anything that starts with "2025/6"
        $gatah = Gatah::where('date', 'like', "$date%")->get();
        $users = User::all();
        $userIds = array_column($gatah->toArray(), 'user_id');

        $gatahList = [];

        for ($i = 0; $i < count($users); $i++) {
            if (in_array($users[$i]->id, $userIds)) {
                $index = array_search($users[$i]->id, $userIds);
                $gatahList[] = [
                    'user_id' => $users[$i]->id,
                    'name' => $users[$i]->name,
                    'phone' => $users[$i]->phone,
                    'isPaid' => $gatah[$index]->is_paid == 1 ? 'paid' : 'review',
                    'gatah_id' => $gatah[$index]->id,
                    'date' => $date
                ];
            } else {
                $gatahList[] = [
                    'user_id' => $users[$i]->id,
                    'name' => $users[$i]->name,
                    'phone' => $users[$i]->phone,
                    'isPaid' => 'unpaid',
                    'date' => $date
                ];
            }
        }

        return response()->json([
            'data' => $gatahList
        ]);
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGatahRequest $request, Gatah $gatah)
    {
        $gatah->update([
            'is_paid' => $request->is_paid
        ]);

        return response()->json([
            'message' => 'status updated',
            'is_paid' => $request->is_paid
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gatah $gatah)
    {
        //
    }
}
