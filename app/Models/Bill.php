<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    /** @use HasFactory<\Database\Factories\BillFactory> */
    use HasFactory;

    protected $fillable = [
        'total',
        'user_id',
        'is_paid'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function percheses()
    {
        return $this->hasMany(Perchese::class);
    }
    public function request()
    {
        return $this->hasOne(BillRequest::class);
    }
}
