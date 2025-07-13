<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GatahRequest extends Model
{
    protected $fillable = ['gatah_id', 'user_id', 'price', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function gatah()
    {
        return $this->belongsTo(Gatah::class);
    }
}
