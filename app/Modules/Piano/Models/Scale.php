<?php

namespace App\Modules\Piano\Models;

use Illuminate\Database\Eloquent\Model;

class Scale extends Model
{
	public $type = 'scale';

	public $fillable = [
		'root',
		'chord',
	];

	protected $appends = ['scale'];

	public function notes () {
		if ($this->type == 'chord') {
			return $this->belongsToMany('App\Modules\Piano\Models\Note', 'scale_note')->where('scale_note.type', 'chord');
		}

		return $this->belongsToMany('App\Modules\Piano\Models\Note', 'scale_note');
	}

	public function notesToString () {
		$result = '';
		foreach ($this->notes as $index => $note) {
			$result .= $index ? ', ' . $note->slug : $note->slug;
		}

		return $result;
	}

	public function containNote ($note) {
		$result = $this->notes->contains(function ($value, $key) use ($note) {
			return $value->slug == $note->slug;
		});

		return $result;
	}

	public function __toString () {
		$chord = $this->chord == 'maj' ? '' : 'min';

		return $this->root . $chord;
	}


}
