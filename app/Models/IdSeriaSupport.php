<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdSeriaSupport extends \Eloquent
{
	protected $table = 'id_seria_support';

	protected $fillable = ['seria', 'may'];
}
