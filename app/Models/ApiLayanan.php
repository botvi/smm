<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiLayanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'key',
        'key_id',
        'profit_percentage'

    ];
}
