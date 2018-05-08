<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Port extends \Eloquent
{
	protected $table = 'ports';

	protected $fillable = ['port'];
}
