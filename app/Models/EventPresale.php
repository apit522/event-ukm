<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPresale extends Model
{
    use HasFactory;
    protected $table = "event_presale";
    protected $fillable = [
        'event_price_id',
        'variant',
        'discount',
        'start_date',
        'due_to',
        'max_purchase'
    ];

    protected $casts = [
        'due_to' => 'datetime',
        'start_date' => 'datetime',
    ];

    public function event_price()
    {
        return $this->belongsTo(EventPrice::class);
    }
}
