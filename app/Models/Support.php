<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends \Eloquent
{
	protected $table = 'supports';

	protected $fillable = ['mail'];
}
