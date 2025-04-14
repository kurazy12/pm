<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'user_id',
        'province_id',
        'title',
        'content',
        'image_path',
        'status',
        'views',
        'likes',
        'status_note',
    ];

    public function province() {
        return $this->belongsTo(Province::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }

}
