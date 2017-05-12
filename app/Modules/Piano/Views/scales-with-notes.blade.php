<div>
	@foreach($notes as $note)
		<span class="btn btn-warning">{{ $note }}</span>
	@endforeach
</div>

<div>
	@foreach($scales as $scale)
		<span class="btn btn-success">{{ $scale }}</span>
	@endforeach
</div>