<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<link href="{{ asset('libs/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	</head>

	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="main-piano-container">
						<div id="ajax-keyboard">
							{!! \App\Modules\Piano\Controllers\KeyboardController::keyboard(app('request')) !!}
						</div>

						<div class="choose">
							<div>
								<label>Chord:</label>
								@foreach(App\Modules\Piano\Models\Note::orderBy('number')->limit(12)->get() as $index => $key)
									<a class="btn btn-default ajax-btn pianoMainChordBtn" data-target="#ajax-keyboard" data-callback="selectScaleBtn"
									   data-url="{{ route('keyboard', ['type' => 'chord', 'root' => $key->name, 'chord' => 'maj']) }}">{{ $key->name }}</a>
								@endforeach
							</div>

							<div>
								<label>Scale:</label>
								@foreach(App\Modules\Piano\Models\Note::orderBy('number')->limit(12)->get() as $index => $key)
									<a class="btn btn-default ajax-btn pianoMainScaleBtn" data-target="#ajax-keyboard" data-callback="selectScaleBtn"
									   data-url="{{ route('keyboard', ['type' => 'scale', 'root' => $key->name, 'chord' => 'maj']) }}">{{ $key->name }}</a>
								@endforeach
							</div>
						</div>
					</div>


				</div>
			</div>


			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Scales:</h3>
						</div>

						<div class="panel-body">
						</div>
					</div>

					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Scales that contain notes:</h3>
						</div>

						<div class="panel-body">
							<div id="ajax-show-scales">
								<div class="choose">
									@foreach(App\Modules\Piano\Models\Note::orderBy('number')->limit(12)->get() as $index => $key)
										<a class="btn btn-default ajax-choose-btn"
										   data-add-url="{{ route('scale-with-notes', ['notes' => request('notes') ? (request('notes') . ',' . $key->id) : $key->id]) }}"
										   data-remove-url="{{ route('scale-with-notes', ['notes' => request('notes'), 'remove-note' => $key->id]) }}">
											{{ $key->name }}
										</a>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="{{ asset('libs/jquery-2.1.1.js') }}"></script>
		<script src="{{ asset('js/app.js') }}"></script>

	</body>
</html>

