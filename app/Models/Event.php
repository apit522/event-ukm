<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'attendant',
        'max_visitor'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function event_price()
    {
        return $this->hasMany(EventPrice::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'event_id');
    }

    public function event_presale()
    {
        return $this->hasMany(EventPresale::class);
    }

    public function getMinPriceAttribute()
    {
        return $this->event_price->min('price');
    }

    public function getFormattedDescriptionAttribute()
    {
        return nl2br($this->description);
    }
    public function getAttendantAttribute()
    {
        $event = $this;
        $totals = DB::table('invoice')
            ->join('event_price', function ($join) use ($event) {
                $join->on(DB::raw("CAST(JSON_UNQUOTE(JSON_EXTRACT(invoice.detail, '$.type')) AS CHAR)"), '=', 'event_price.variant')
                    ->where('event_price.event_id', '=', $event->id);
            })
            ->select('event_price.variant', DB::raw("SUM(CAST(JSON_UNQUOTE(JSON_EXTRACT(invoice.detail, '$.quantity')) AS SIGNED)) as totalQuantity"))
            ->where('invoice.event_id', '=', $event->id) // Memastikan event_id pada Invoice sesuai dengan Event tertentu
            ->where('invoice.status', '=', 1)
            ->groupBy('event_price.variant')
            ->get();
        return $totals;
    }
    public function getMaxVisitorAttribute()
    {
        $maxVisitors = DB::table('event_price')
            ->select('variant', 'max_visitor')
            ->where('event_id', '=', $this->id)
            ->get();

        return $maxVisitors;
    }
}
