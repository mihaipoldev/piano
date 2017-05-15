<div class="choose">
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

<div>
	@foreach($scales as $scale)
		<span>{{ $scale }}</span>
	@endforeach
</div>