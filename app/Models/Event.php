<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = "event";
    protected $fillable = [
        'post_id',
        'name',
        'description',
        'location',
        'date'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    protected $appends = [
        'min_price',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function event_price()
    {
        return $this->hasMany(EventPrice::class);
    }
    public function event_presale()
    {
        return $this->hasMany(EventPresale::class);
    }

    public function getMinPriceAttribute()
    {
        return $this->event_price->min('price');
    }
}
