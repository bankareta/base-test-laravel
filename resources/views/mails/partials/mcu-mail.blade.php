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
			@if ($record->status == 1)
				You Have a New <b>Medical Check Up</b> result, please check the link below.
			@elseif($record->status == 2)
				You Have a New <b>Medical Check Up Appointment Schedule</b> with employee on <b>{{ Helpers::DateParse($record->appointment_date) }}</b> at <b>{{ $record->appointment_location}}</b>, please check the link below.
			@else
				You Have a New <b>Medical Check Up</b> for create result MCU, please check the link below.
			@endif 
			{!! $record->content or '' !!}
		</p>
		<div style="clear: both;"></div>
	
</div>

@endsection