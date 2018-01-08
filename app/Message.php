<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = [
        'user_id_from', 'user_id_to', 'content', 'conversation_id'
    ];

    public function user() {
        return $this->hasMany('App\User');
    }

    public function conversation() {
        return $this->belongsTo('App\Conversation');
    }
}
