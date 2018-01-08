<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'picture',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function commentaries() {
        return $this->hasMany('App\Commentary');
    }

    public function likes() {
        return $this->hasMany('App\Like');
    }
}
