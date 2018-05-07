<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apple extends \Eloquent
{
    protected $table = 'apples';
    protected $fillable = ['apple_id', 'password', 'answer_first', 'answer_second', 'domain', 'user_id'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}