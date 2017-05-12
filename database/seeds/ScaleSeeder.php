<?php

use App\Modules\Piano\Models\Note;
use App\Modules\Piano\Models\Scale;
use Illuminate\Database\Seeder;

class ScaleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		foreach(Note::orderBy('number')->limit(12)->get() as $note) {
			// major
			$scale = new Scale();
			$scale->root = $note->name;
			$scale->chord = 'maj';
			$scale->save();

			foreach($this->majorFormula() as $noteFormula) {
				$scale->notes()->save(Note::where('number', $note->number + $noteFormula)->first());
			}

			// minor
			$scale = new Scale();
			$scale->root = $note->name;
			$scale->chord = 'min';
			$scale->save();

			foreach($this->minorFormula() as $noteFormula) {
				$scale->notes()->save(Note::where('number', $note->number + $noteFormula)->first());
			}
		}
	}

	private function majorFormula() {
		return [0, 2, 4, 5, 7, 9, 11];
	}

	private function minorFormula() {
		return [0, 2, 3, 5, 7, 8, 10];
	}
}
