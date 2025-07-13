<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gatah extends Model
{
    /** @use HasFactory<\Database\Factories\GatahFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'date', 'is_paid'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function request()
    {
        return $this->hasOne(GatahRequest::class);
    }
}
