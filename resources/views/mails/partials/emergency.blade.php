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
					<h3>Company: : {{ $record->site->name or '' }}</h3>
				</p>
			</th>
			<th colspan="3" class="text-pull-right">
				<p>
					<h3>Person Completing Form and Title: : {{ $record->titlePerson->display or '' }}</h3>
				</p>
			</th>
		</tr>	
		<tr>
			<th>Date</th>
			<th>:</th>
			<th class="font-color" style="width: 220px">{{ $record->date or '' }}</th>
			
			<th>No Emergency Drill:</th>
			<th>:</th>
			<th class="font-color">{{ $record->no_doc or '' }}</th>

		</tr>
		<tr>
			<th>Time Alarm Sounded:</th>
			<th>:</th>
			<th class="font-color">{{ $record->time_alarm or '' }}</th>
			
			<th>Time Drill Concluded:</th>
			<th>:</th>
			<th class="font-color">{{ $record->time_drill or '' }}</th>
		</tr>
		<tr>
			<th>Time to Evacuate: (fire evacuation drills only) </th>
			<th>:</th>
			<th class="font-color">{{ $record->time_evacuate or '' }}</th>
		</tr>
</thead>
</table>


@endsection