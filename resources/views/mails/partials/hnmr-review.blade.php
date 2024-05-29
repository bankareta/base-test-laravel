@extends('mails.header',[
	'title' => " ".$title,
	'link' => $urls
	])
	@section('body')
	<style>

</style>
<table style="font-size: 12px;border-collapse: collapse;">
	<thead class="text-pull-left">
		<tr>
			<th colspan="3">
				<p>
					<h3>Report No : <u style="color : #E8210E;">{!! $record->no_report or '' !!}</u></h3>
				</p>
			</th>
			<th colspan="3" class="text-pull-right">
				<p>
                    <h3>Reported By : <u style="color : #E8210E;">{!! $record->reported->display or '' !!}</u></h3>
				</p>
			</th>
		</tr>
		<tr>
			<th>Date</th>
			<th>:</th>
			<th class="font-color" style="width: 220px">{{ Helpers::DateToString($record->date) }}</th>

			<th>Name Of Supervisor</th>
			<th>:</th>
			<th class="font-color">{!! $record->spv->display or '' !!}</th>

		</tr>
		<tr>
			<th>Departmen</th>
			<th>:</th>
			<th class="font-color">{!! $record->department->name or '' !!}</th>

			
			<th>Company</th>
			<th>:</th>
			<th class="font-color">
				 {!! $record->site->name or '' !!} 
			</th>
		</tr>
		<tr>
			<th>Location</th>
			<th>:</th>
			<th class="font-color">
                {!! $record->location or '' !!}
            </th>
		</tr>
    </thead>
</table><br>
<div class="row mt-5 pt-5">

		<div class="rdg-expertise-category"><span>Hazard Reported :</span></div><br>
			<p style="font-size: 11px" class="font-color">
                {!! $record->report or '' !!}
			</p>
</div>


@endsection
