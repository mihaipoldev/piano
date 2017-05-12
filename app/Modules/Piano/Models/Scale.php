<?php

namespace App\Modules\Piano\Models;

use Illuminate\Database\Eloquent\Model;

class Scale extends Model
{
	public $fillable = [
		'root',
		'chord',
	];

	public function notes(){
		return $this->belongsToMany('App\Modules\Piano\Models\Note', 'scale_note');
	}

	public function containNote($note){
		$result = $this->notes->contains(function($value, $key) use ($note){
			return $value->slug == $note->slug;
		});

		return $result;
	}

	public function __toString() {
		$chord = $this->chord == 'maj' ? '' : 'min';
		return $this->root . $chord;
	}


}
