<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $table = 'credit_cards';

	protected $fillable = ['number', 'user_id'];

	public function user() {
		return $this->belongsTo('App\Models\User');
	}
}
