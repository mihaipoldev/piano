<?php

use App\Modules\Piano\Models\Note;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
	public function run() {
		Note::create([
			'name'   => 'C',
			'slug'   => 'C',
			'number' => 1,
			'color'  => 'white',
		]);

		Note::create([
			'name'   => 'C#',
			'slug'   => 'C#',
			'number' => 2,
			'color'  => 'black',
		]);

		Note::create([
			'name'   => 'D',
			'slug'   => 'D',
			'number' => 3,
			'color'  => 'white',
		]);

		Note::create([
			'name'   => 'D#',
			'slug'   => 'D#',
			'number' => 4,
			'color'  => 'black',
		]);

		Note::create([
			'name'   => 'E',
			'slug'   => 'E',
			'number' => 5,
			'color'  => 'white',
		]);

		Note::create([
			'name'   => 'F',
			'slug'   => 'F',
			'number' => 6,
			'color'  => 'white',
		]);

		Note::create([
			'name'   => 'F#',
			'slug'   => 'F#',
			'number' => 7,
			'color'  => 'black',
		]);

		Note::create([
			'name'   => 'G',
			'slug'   => 'G',
			'number' => 8,
			'color'  => 'white',
		]);

		Note::create([
			'name'   => 'G#',
			'slug'   => 'G#',
			'number' => 9,
			'color'  => 'black',
		]);

		Note::create([
			'name'   => 'A',
			'slug'   => 'A',
			'number' => 10,
			'color'  => 'white',
		]);

		Note::create([
			'name'   => 'A#',
			'slug'   => 'A#',
			'number' => 11,
			'color'  => 'black',
		]);

		Note::create([
			'name'   => 'B',
			'slug'   => 'B',
			'number' => 12,
			'color'  => 'white',
		]);


		Note::create([
			'name'   => 'C2',
			'slug'   => 'C',
			'number' => 13,
			'color'  => 'white',
		]);

		Note::create([
			'name'   => 'C#2',
			'slug'   => 'C#',
			'number' => 14,
			'color'  => 'black',
		]);

		Note::create([
			'name'   => 'D2',
			'slug'   => 'D',
			'number' => 15,
			'color'  => 'white',
		]);

		Note::create([
			'name'   => 'D#2',
			'slug'   => 'D#',
			'number' => 16,
			'color'  => 'black',
		]);

		Note::create([
			'name'   => 'E2',
			'slug'   => 'E',
			'number' => 17,
			'color'  => 'white',
		]);

		Note::create([
			'name'   => 'F2',
			'slug'   => 'F',
			'number' => 18,
			'color'  => 'white',
		]);

		Note::create([
			'name'   => 'F#2',
			'slug'   => 'F#',
			'number' => 19,
			'color'  => 'black',
		]);

		Note::create([
			'name'   => 'G2',
			'slug'   => 'G',
			'number' => 20,
			'color'  => 'white',
		]);

		Note::create([
			'name'   => 'G#2',
			'slug'   => 'G#',
			'number' => 21,
			'color'  => 'black',
		]);

		Note::create([
			'name'   => 'A2',
			'slug'   => 'A',
			'number' => 22,
			'color'  => 'white',
		]);

		Note::create([
			'name'   => 'A#2',
			'slug'   => 'A#',
			'number' => 23,
			'color'  => 'black',
		]);

		Note::create([
			'name'   => 'B2',
			'slug'   => 'B',
			'number' => 24,
			'color'  => 'white',
		]);
	}
}
