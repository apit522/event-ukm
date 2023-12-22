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

    protected $appends = [
        'price'
    ];

    protected $casts = [
        'due_to' => 'datetime',
        'start_date' => 'datetime',
    ];

    public function event_price()
    {
        return $this->belongsTo(EventPrice::class);
    }
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
    public function getPriceAttribute()
    {
        $price = $this->event_price->price - ($this->event_price->price * $this->discount / 100);
        return $price;
    }
}
