<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $fillable = ['balance', 'added', 'spent', 'discription'];
}
