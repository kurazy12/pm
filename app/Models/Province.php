<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }
}
