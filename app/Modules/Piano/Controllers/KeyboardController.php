<?php

namespace App\Modules\Piano\Controllers;

use App\Modules\Piano\Models\Note;
use App\Modules\Piano\Models\Scale;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KeyboardController
{
	/**
	 * Keyboard
	 *
	 * @param Request $request
	 * @return View
	 */
	public static function keyboard(Request $request){
		$scale = [];

		switch($request['type']){
			case 'scale':
				$scale = Scale::where('root', $request['root'])
					->where('chord', $request['chord'])
					->first();
				break;

			default:
				// $scale = Scale::where('root', 'C')
				// 	->where('chord', 'maj')
				// 	->first();
				break;
		}

		return view('Piano::keyboard', [
			'scale' => $scale,
		]);
	}

	public function scalesWithNotes(Request $request){
		$notesExploded = explode(',', $request['notes']);

		$notes = collect();
		foreach($notesExploded as $note){
			$notes->push(Note::find($note));
		}

		// Scale::find(28)->containNote(Note::where('slug', 'A')->first());

		$scales = [];
		foreach(Scale::all() as $scale){
			$ok = true;

			echo 'scale: ' . $scale . ' - ';

			foreach($notes as $note){
				if(!$scale->containNote($note)){
					echo 'not-contain '.$note.' <br>';
					$ok = false;
					break;
				};
				echo 'contain '.$note.' <br>';


			}

			if($ok){
				$scales[] = $scale;
			}
		}

		dump(Scale::all());
		dump($request['notes']);

		return view('Piano::scales-with-notes', [
			'notes' => $notes,
			'scales' => $scales
		]);
	}
}