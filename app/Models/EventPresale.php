<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPresale extends Model
{
    use HasFactory;
    protected $table = "event_presale";
    protected $fillable = [
        'event_id',
        'variant',
        'discount',
        'due_to'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
