<?php

use App\Modules\Piano\Models\Note;
use App\Modules\Piano\Models\Scale;

Route::get('/', function () {

	$note = Note::where('number', 1)->first();
	return view('Piano::index', [
		'note' => $note,
	]);
})->name('index');

Route::group(['namespace' => 'App\Modules\Piano\Controllers'], function(){
	Route::get('/keyboard', [
		'uses' => 'KeyboardController@keyboard',
		'as' => 'keyboard'
	]);

	Route::get('/scales-with-notes', [
		'uses' => 'KeyboardController@scalesWithNotes',
		'as' => 'scale-with-notes'
	]);
});




function majorFormula() {
	return [0, 2, 4, 5, 7, 9, 11];
}

function minorFormula() {
	return [0, 2, 3, 5, 7, 8, 10];
}