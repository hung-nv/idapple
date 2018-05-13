<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdSeria extends \Eloquent
{
	protected $table = 'id_seria';

	protected $fillable = ['seria', 'may'];
}
