<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
	use SoftDeletes;
	
	protected $fillable = [
			//
	];
	
	protected $guards = [
			//
	];
	
	protected $hidden = [
			//
	];
	
	protected $dates = [
			//
	];
	
	protected $casts = [
			'boolean' => 'bool',
	];
	
}
