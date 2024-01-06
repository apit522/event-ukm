<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "post";
    protected $fillable = [
        'ukm_id',
        'judul',
        'description'
    ];

    protected $appends = [
        'status',
        'images',
        'cover_image',
        'ukm_username',
        'dibuat',
    ];

    public function ukm()
    {
        return $this->belongsTo(UKM::class, 'ukm_id');
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

    public function getStatusAttribute()
    {
        if ($this->event && $this->event->min_price != 0) {
            return "Paid";
        } elseif ($this->event) {
            return "Free";
        } else {
            return "Post";
        }
    }

    public function getImagesAttribute()
    {
        return $this->post_photo->pluck('file');
    }

    public function getCoverImageAttribute()
    {
        $coverPhoto = $this->post_photo->where('cover', 1)->first();

        return $coverPhoto ? $coverPhoto->file : null;
    }

    public function getUkmUsernameAttribute()
    {
        return $this->ukm->username;
    }


    public function getDibuatAttribute()
    {
        Carbon::setLocale('id');

        $createdDate = $this->asDateTime($this->created_at);

        // Jika melewati 7 hari, tampilkan format tanggal
        if ($createdDate->diffInDays() > 7) {
            return $createdDate->format('d F Y');
        }

        // Jika belum melewati 7 hari, tampilkan diffForHumans
        return $createdDate->diffForHumans();
    }
}
