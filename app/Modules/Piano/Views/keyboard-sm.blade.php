<div class="keyboard clearfix keyboard-sm {{ $scale ? $scale->type : '' }}">
@foreach(pianoNotesSm() as $note)
	@if($scale)
		@if($scale->notes->contains($note))
			<span class="key {{ $note->color }} active">{{ $note->slug }}</span>
		@else
			<span class="key {{ $note->color }}"></span>
		@endif
	@else
		<span class="key {{ $note->color }}"></span>
	@endif
@endforeach
</div>