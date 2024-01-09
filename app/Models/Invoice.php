<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = "invoice";
    protected $fillable = [
        'event_id',
        'last_three_value',
        'nama_pemilik',
        'status',
        'price',
        'detail'
    ];

    protected $casts = [
        'detail' => 'array'
    ];
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
