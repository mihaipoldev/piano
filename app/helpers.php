<?php

use App\Modules\Piano\Models\Note;

function pianoNotes(){
	$notes = [];

	foreach(Note::orderBy('number')->limit(12)->get() as $note){
		$note->id = null;
		$notes[] = $note;
	}

	foreach(Note::orderBy('number')->get() as $note){
		$notes[] = $note;
	}

	foreach(Note::orderBy('number')->limit(12)->get() as $note){
		$note->id = null;
		$note->number = 0;
		$notes[] = $note;
	}

	return $notes;
}

function pianoNotesSm(){
	$notes = [];

	foreach(Note::orderBy('number')->get() as $note){
		$notes[] = $note;
	}

	return $notes;
}

function chordsNames(){
	return ['chord', 'scale'];
}