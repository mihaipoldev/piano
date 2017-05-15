<?php

Route::group(['namespace' => 'App\Modules\Piano\Controllers'], function() {
	Route::get('/', [
		'uses' => 'KeyboardController@index',
		'as'   => 'index',
	]);

	Route::get('/keyboard', [
		'uses' => 'KeyboardController@keyboard',
		'as'   => 'keyboard',
	]);

	Route::get('/scales-with-notes', [
		'uses' => 'KeyboardController@scalesWithNotes',
		'as'   => 'scale-with-notes',
	]);
});


function majorFormula() {
	return [0, 2, 4, 5, 7, 9, 11];
}

function minorFormula() {
	return [0, 2, 3, 5, 7, 8, 10];
}