<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // управляемая таблица
    protected $table = 'settings';

    protected $casts = [
        'purpose' => 'array',
        'apartment_cost' => 'array',
        'first_payment' => 'array',
        'credit_term' => 'array',
    ];
}
