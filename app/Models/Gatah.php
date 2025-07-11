<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gatah extends Model
{
    /** @use HasFactory<\Database\Factories\GatahFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'date', 'is_paid'];
}
