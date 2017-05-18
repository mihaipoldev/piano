<div class="choose text-center">
	@foreach(App\Modules\Piano\Models\Note::orderBy('number')->limit(12)->get() as $index => $key)
		@if($notes->contains($key))
			<a class="btn btn-default ajax-btn active" data-target="#ajax-show-scales"
			   data-url="{{ route('scale-with-notes', ['notes' => $newRequest, 'remove-note' => $key->id]) }}">
				{{ $key->name }}
			</a>
		@else
			<a class="btn btn-default ajax-btn" data-target="#ajax-show-scales"
			   data-url="{{ route('scale-with-notes', ['notes' => $newRequest . ',' . $key->id]) }}">
				{{ $key->name }}
			</a>
		@endif
	@endforeach
</div>

<div class="scales-with-notes">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="row">
				@foreach($scales as $scale)
					<div class="col-md-6">
						<div class="item clearfix">
							<h4 class="">{{ $scale }}</h4>
							@include('Piano::keyboard-sm', ['scale' => $scale])
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>