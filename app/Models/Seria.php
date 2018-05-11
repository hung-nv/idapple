<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seria extends Model
{
	protected $table = 'seria';

	protected $fillable = ['seria', 'user_id'];
}
