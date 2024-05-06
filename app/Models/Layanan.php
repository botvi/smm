<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'type',
        'kategori_id',
        'price',
        'min',
        'max',
        'description',
        'refill',
        'average_time',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
