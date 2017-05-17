<div class="keyboard clearfix {{ $scale ? $scale->type : '' }}">
	@foreach(pianoNotes() as $note)
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

<div class="choose">
	@foreach(chordsNames() as $chord)
		<div class="note-list {{ $chord }}">
			<span>{{ ucfirst($chord) }}:</span>

			@foreach(App\Modules\Piano\Models\Note::orderBy('number')->limit(12)->get() as $index => $note)
				<div class="select-note-wrap">
					<a class="select-note {{ $note->color }} ajax-btn" data-target="#ajax-piano-app" data-callback="selectScaleBtn"
					   data-url="{{ route('keyboard', ['type' => $chord, 'root' => $note->name, 'chord' => 'maj']) }}">
						{{ $note->name }}
					</a>

					<div class="select-chord-wrap">
						<a class="select-chord {{ $note->color }} ajax-btn" data-target="#ajax-piano-app" data-callback="selectScaleBtn"
						   data-url="{{ route('keyboard', ['type' => $chord, 'root' => $note->name, 'chord' => 'maj']) }}">
							{{ $note->name }} <small>Maj</small>
						</a>

						<a class="select-chord {{ $note->color }} ajax-btn" data-target="#ajax-piano-app" data-callback="selectScaleBtn"
						   data-url="{{ route('keyboard', ['type' => $chord, 'root' => $note->name, 'chord' => 'min']) }}">
							{{ $note->name }} <small>Min</small>
						</a>
					</div>
				</div>
			@endforeach
		</div>
	@endforeach
</div>

@if($scale)
	<div class="scale-info">
		<div>
			<h4><strong>{{ $scale->root . ' ' . ucfirst($scale->chord) }}</strong></h4>
		</div>

		<div>
			<label>Notes:</label> {{ $scale->notesToString() }}
		</div>
	</div>
@endif