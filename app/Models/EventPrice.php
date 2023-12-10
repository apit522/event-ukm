<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPrice extends Model
{
    use HasFactory;

    protected $table = "event_price";
    protected $fillable = [
        'event_id',
        'variant',
        'price',
        'max_visitor'
    ];


    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function event_price()
    {
        return $this->hasMany(EventPresale::class);
    }
}
