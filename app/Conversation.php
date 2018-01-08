<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{

    protected $fillable = [
        'id_conv',
    ];

    public function messages() {
        return $this->hasMany('App\Message');
    }
}
