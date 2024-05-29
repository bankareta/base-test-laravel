@extends('mails.header',[
	'title' => " ".$title,
	'link' => $urls,
	'subtitle' => isset($subtitle) ? $subtitle : ''
	])
	@section('body')
	<style>

</style>
<div class="row mt-5 pt-5">
	
		<div class="rdg-expertise-category"><span>Training Course</span></div><br>
	
			<p style="font-size: 11px" class="font-color">
				You Have a New Course <b>{{ $record->title or  '' }}</b> for training please check the link below. 
				{!! $record->content or '' !!}
			</p>
			<div style="clear: both;"></div>
	
</div>

@endsection