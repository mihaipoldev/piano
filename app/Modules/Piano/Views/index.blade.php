<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<link href="{{ asset('libs/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	</head>

	<body>
		<header>
			<ul>
				<li><a href="{{ route('index') }}">Piano</a></li>
			</ul>
		</header>

		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div id="ajax-piano-app">
						{!! \App\Modules\Piano\Controllers\KeyboardController::keyboard(app('request')) !!}
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<h2 class="text-center">Scale that contain notes:</h2>

					<div id="ajax-show-scales">
						{!! \App\Modules\Piano\Controllers\KeyboardController::scalesWithNotes(app('request')) !!}
					</div>
				</div>
			</div>
		</div>

		<script src="{{ asset('libs/jquery-2.1.1.js') }}"></script>
		<script src="{{ asset('js/app.js') }}"></script>

	</body>
</html>

