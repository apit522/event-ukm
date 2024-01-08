<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UKM extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = "UKM";
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'profile_picture',
        'description',
        'twitter',
        'facebook',
        'youtube',
        'instagram'
    ];
    protected $guard = 'ukm';
    protected $appends = [
        'post_count',
        'event_count'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function post()
    {
        return $this->hasMany(Post::class, 'ukm_id');
    }

    public function getPostCountAttribute()
    {
        return $this->post()->count();
    }
    public function getEventCountAttribute()
    {
        $number = 0;
        foreach ($this->post as $post) {
            if (!$post->event) {
                break;
            }
            $number++;
        }

        return $number;
    }

    public function getPostsDataAttribute()
    {
        return $this->post->map(function ($post) {
            return [
                'post_name' => $post->judul,
                'traffic_count' => $post->traffic_count,
                'shares_count' => $post->shares_count,
            ];
        });
    }
}
