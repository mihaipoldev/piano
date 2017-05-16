<?php

namespace App\Modules\Piano\Controllers;

use App\Modules\Piano\Models\Note;
use App\Modules\Piano\Models\Scale;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KeyboardController
{
	/**
	 * Index
	 *
	 * @param Request $request
	 * @return View
	 */
	public function index(Request $request){
		return view('Piano::index');
	}

	/**
	 * Keyboard
	 *
	 * @param Request $request
	 * @return View
	 */
	public static function keyboard(Request $request) {
		$scale = Scale::where('root', $request['root'] ? $request['root'] : 'C')
			->where('chord', $request['chord'] ? $request['chord'] : 'maj')
			->first();

		if($scale){
			$scale->type = $request['type'] ? $request['type'] : 'scale';
		}

		return view('Piano::keyboard', [
			'scale' => $scale,
		]);
	}

	/**
	 * Scales that contains notes
	 *
	 * @param Request $request
	 * @return View
	 */
	public static function scalesWithNotes(Request $request) {
		$notesExploded = explode(',', $request['notes']);

		$notes = collect();
		foreach($notesExploded as $note) {
			if($note != $request['remove-note']) {
				$notes->push(Note::find($note));
			}
		}

		$scales = [];
		if($notes->count()){
			foreach(Scale::all() as $scale) {
				$ok = 1;

				foreach($notes as $note) {
					if(!$scale->containNote($note)) {
						//					echo 'not-contain '.$note.' <br>';
						$ok = 0;
						break;
					};
				}

				if($ok) {
					$scales[] = $scale;
				}
			}
		}

		$newRequest = '';
		foreach($notes as $index => $note) {
			$newRequest .= $index ? ',' . $note->id : $note->id;
		}

		return view('Piano::scales-with-notes', [
			'notes'      => $notes,
			'newRequest' => $newRequest,
			'scales'     => $scales,
		]);
	}
}