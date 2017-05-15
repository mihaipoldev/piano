@if($scale)
	<div class="piano clearfix {{ $scale->type }}">
		@foreach(pianoNotes() as $note)
			@if($scale->notes->contains($note))
				<span class="key {{ $note->color }} active">{{ $note->slug }}</span>
			@else
				<span class="key {{ $note->color }}"></span>
			@endif
		@endforeach
	</div>
@else
	<div class="piano clearfix">
		@foreach(pianoNotes() as $note)
			<span class="key {{ $note->color }}"></span>
		@endforeach
	</div>
@endif