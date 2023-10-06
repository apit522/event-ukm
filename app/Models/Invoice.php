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
        'qris_content',
        'qris_content',
        'status',
        'price'
    ];


    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
