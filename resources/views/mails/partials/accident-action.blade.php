@extends('mails.header',[
	'title' => " ".$title,
	'link' => $urls,
	'subtitle' => isset($subtitle) ? $subtitle : ''
	])
	@section('body')
	<style>

</style>
<table style="font-size: 12px;border-collapse: collapse;">
	<thead class="text-pull-left">
		<tr>
			<th colspan="3">
				<p>
					<h3>Report No : <u style="color : #E8210E;">{!! $record->accident->incident_number or '' !!}</u></h3>
				</p>
			</th>
			<th colspan="3" class="text-pull-right">
				<p>
                    <h3>Reported By : <u style="color : #E8210E;">{!! $record->accident->investigationrequest->display or '' !!}</u></h3>
				</p>
			</th>
		</tr>
		<tr>
			<th>Date</th>
			<th>:</th>
			<th class="font-color" style="width: 220px">{{ $record->accident->date_of_incident }}</th>

			<th>Name Of Supervisor</th>
			<th>:</th>
			<th class="font-color">{!! $record->accident->reviewedby->display or '' !!}</th>

		</tr>
		<tr>
			<th>Company</th>
			<th>:</th>
			<th class="font-color">{!! $record->accident->site->name or '' !!}</th>

			<th>Location</th>
			<th>:</th>
			<th class="font-color">{!! $record->accident->incident_location or '' !!}
            </th>
		</tr>
    </thead>
</table>
<br>
<br>
<b style="font-size: 16px;">Recommendation & Action Plan</b> <small style="color: gray;font-size:10px;"> PIC :<u style="color : gray;"> {!! $record->pic->display or '' !!} </u> &nbsp; Due Date : <i>{{ Helpers::DateToString($record->due_date) }}</i></small>
<hr>
<div class="row mt-5 pt-5">
	<div class="col-6">
		<div class="rdg-expertise-description">
			{!! $record->recomendation or '' !!}
		</div>
	</div>
</div>
<br>
@endsection
