<?php

use App\Modules\Piano\Models\Note;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    public function run()
    {
    	Note::create([
    		'name' => 'C',
		    'number' => 1,
		    'is_black' => false
	    ]);

	    Note::create([
		    'name' => 'C#',
		    'number' => 2,
		    'is_black' => true
	    ]);

	    Note::create([
		    'name' => 'D',
		    'number' => 3,
		    'is_black' => false
	    ]);

	    Note::create([
		    'name' => 'D#',
		    'number' => 4,
		    'is_black' => true
	    ]);

	    Note::create([
		    'name' => 'E',
		    'number' => 5,
		    'is_black' => false
	    ]);

	    Note::create([
		    'name' => 'F',
		    'number' => 6,
		    'is_black' => false
	    ]);

	    Note::create([
		    'name' => 'F#',
		    'number' => 7,
		    'is_black' => true
	    ]);

	    Note::create([
		    'name' => 'G',
		    'number' => 8,
		    'is_black' => false
	    ]);

	    Note::create([
		    'name' => 'G#',
		    'number' => 9,
		    'is_black' => true
	    ]);

	    Note::create([
		    'name' => 'A',
		    'number' => 10,
		    'is_black' => false
	    ]);

	    Note::create([
		    'name' => 'A#',
		    'number' => 11,
		    'is_black' => true
	    ]);

	    Note::create([
		    'name' => 'B',
		    'number' => 12,
		    'is_black' => false
	    ]);



	    Note::create([
		    'name' => 'C2',
		    'number' => 13,
		    'is_black' => false
	    ]);

	    Note::create([
		    'name' => 'C#2',
		    'number' => 14,
		    'is_black' => true
	    ]);

	    Note::create([
		    'name' => 'D2',
		    'number' => 15,
		    'is_black' => false
	    ]);

	    Note::create([
		    'name' => 'D#2',
		    'number' => 16,
		    'is_black' => true
	    ]);

	    Note::create([
		    'name' => 'E2',
		    'number' => 17,
		    'is_black' => false
	    ]);

	    Note::create([
		    'name' => 'F2',
		    'number' => 18,
		    'is_black' => false
	    ]);

	    Note::create([
		    'name' => 'F#2',
		    'number' => 19,
		    'is_black' => true
	    ]);

	    Note::create([
		    'name' => 'G2',
		    'number' => 20,
		    'is_black' => false
	    ]);

	    Note::create([
		    'name' => 'G#2',
		    'number' => 21,
		    'is_black' => true
	    ]);

	    Note::create([
		    'name' => 'A2',
		    'number' => 22,
		    'is_black' => false
	    ]);

	    Note::create([
		    'name' => 'A#2',
		    'number' => 23,
		    'is_black' => true
	    ]);

	    Note::create([
		    'name' => 'B2',
		    'number' => 24,
		    'is_black' => false
	    ]);
    }
}
