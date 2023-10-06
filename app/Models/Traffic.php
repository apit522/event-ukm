<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traffic extends Model
{
    use HasFactory;

    protected $table = "traffic";
    protected $fillable = [
        'post_id',
        'view',
        'share'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
