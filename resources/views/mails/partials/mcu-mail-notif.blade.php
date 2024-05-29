@extends('mails.header',[
	'title' => " ".$title,
	'link' => $urls,
	'subtitle' => isset($subtitle) ? $subtitle : ''
	])
	@section('body')
	<style>

</style>
<div class="row mt-5 pt-5">
	
		<div class="rdg-expertise-category"><span>Medical Check Up</span></div><br>

		<p style="font-size: 11px" class="font-color">
            Your <b>Medical Check Up is overdue</b> on <b>{{ Helpers::DateParse($record->due_date) }}</b>, please check the link below for create appointment date & appointment location.
			{!! $record->content or '' !!}
		</p>
		<div style="clear: both;"></div>
	
</div>

@endsection