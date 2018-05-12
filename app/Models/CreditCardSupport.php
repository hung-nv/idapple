<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditCardSupport extends \Eloquent
{
	protected $table = 'credit_card_support';

	protected $fillable = ['number'];
}
