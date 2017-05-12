<?php

namespace App\Modules\Piano\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
	public $fillable = [
		'name',
		'number',
		'is_black',
	];

	public function scales(){
		return $this->belongsToMany('App\Modules\Piano\Models\Scale', 'scale_note');
	}

	public function __toString() {
		return $this->name;
	}
}
