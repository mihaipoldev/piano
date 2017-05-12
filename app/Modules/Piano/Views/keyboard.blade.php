<div class="piano clearfix">
	@foreach(App\Modules\Piano\Models\Note::orderBy('number')->get() as $index => $key)
		<span class="key {{ $key->is_black ? 'black' : 'white' }}{{ ($scale and $scale->notes->contains($key)) ? ' active' : '' }}"></span>
	@endforeach
</div>