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

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function event_price()
    {
        return $this->hasMany(EventPrice::class);
    }
}
