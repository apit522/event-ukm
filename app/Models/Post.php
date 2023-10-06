<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "post";
    protected $fillable = [
        'ukm_id',
        'description'
    ];

    public function ukm()
    {
        return $this->belongsTo(UKM::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    public function post_photo()
    {
        return $this->hasMany(PostPhoto::class);
    }
    public function event()
    {
        return $this->hasOne(Event::class);
    }
    public function traffic()
    {
        return $this->belongsTo(Traffic::class);
    }
}
