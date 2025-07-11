<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillRequest extends Model
{
    protected $fillable = ['bill_id', 'user_id', 'price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
