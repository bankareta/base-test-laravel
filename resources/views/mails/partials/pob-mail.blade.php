@extends('mails.header',[
	'title' => " ".$title,
	'link' => $urls,
	'subtitle' => isset($subtitle) ? $subtitle : ''
	])
	@section('body')
	<style>

</style>
<div class="row mt-5 pt-5">
	
		<div class="rdg-expertise-category"><span>SHE Observation Card</span></div><br>

		<p style="font-size: 11px" class="font-color">
			@if ($record->type == 3)
				You Have a New <b>SHE Observation Card</b> reviewed, please check the link below.
			@elseif($record->type == 2)
				You Have a New <b>SHE Observation Card</b> reviewed, please check the link below.
			@else
				You Have a New <b>SHE Observation Card</b> result, please check the link below.
			@endif 
			{!! $record->content or '' !!}
		</p>
		<div style="clear: both;"></div>
	
</div>

@endsection