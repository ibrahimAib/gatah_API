<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perchese extends Model
{
    /** @use HasFactory<\Database\Factories\PercheseFactory> */
    use HasFactory;
    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
