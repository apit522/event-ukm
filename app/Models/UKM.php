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
}
