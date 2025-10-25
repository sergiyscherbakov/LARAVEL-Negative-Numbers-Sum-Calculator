<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    protected $fillable = ['value'];

    protected $casts = [
        'value' => 'decimal:2',
    ];
}
