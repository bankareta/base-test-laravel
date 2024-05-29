@extends('mails.header',[
	'title' => " ".$title,
	'link' => $urls,
	'subtitle' => isset($subtitle) ? $subtitle : ''
	])
	@section('body')
	<style>

</style>
<table style="font-size: 12px;border-collapse: collapse;" width="100%">
	<thead class="text-pull-left">
		<tr>
			<th colspan="3">
				<p>
					<h3>Report No : <u style="color : #E8210E;">{!! $record->no_report or '' !!}</u></h3>
				</p>
			</th>
			<th colspan="3" class="text-pull-right">
				<p>
          <h3>Analisys By : <u style="color : #E8210E;">{!! $record->analysisby->display or '' !!}</u></h3>
				</p>
			</th>
		</tr>
		<tr>
			<th>Title</th>
			<th>:</th>
			<th class="font-color" colspan="4" style="width: 220px">{{ Helpers::DateToString($record->date) }}</th>
		</tr>
		<tr>
			<th>Reviewed By</th>
			<th>:</th>
			<th class="font-color">{!! $record->reviewedby->display or '' !!}</th>

			<th colspan="3" rowspan="3" align="center" valign="middle"><img src="http://supreme.pragmainf.tech/public/img/risk%20unacceptable.png" height="100px"></th>
		</tr>
		<tr>
			<th>Approved By</th>
			<th>:</th>
			<th class="font-color">{!! $record->approvedby->display or '' !!}</th>
		</tr>
    </thead>
</table>
<table style="font-size: 12px;border-collapse: collapse;border: solid 1px;" class="bordered" width="100%">
	<tr>
		<th class="bg-bluegray" align="center">Process Steps</th>
		<th class="bg-bluegray" align="center">Potential Hazard</th>
		<th class="bg-bluegray" align="center">Risk Level</th>
		<th class="bg-bluegray" align="center">Controle Measures</th>
		<th class="bg-bluegray" align="center">Residual Risk</th>
	</tr>
	<tr>
		<th align="center"><small>List the steps required to perform the task in the sequence they are carried out</small></th>
		<th align="center"><small>List the potential hazards that could cause injury when the task is performed</small></th>
		<th align="center"><small>Consequence & Likelihood</small></th>
		<th align="center"><small>For each hazard identified, list the control measures required to eliminate or minimise the risk of injury</small></th>
		<th align="center"><small>Consequence & Likelihood</small></th>
	</tr>
	@if($record->steps->count() > 0)
		@foreach($record->steps as $key => $step)
			<tr>
				<td class="top aligned">
					{!! $step->process_step or '' !!}
				</td>
				<td class="top aligned">
					{!! $step->potential_hazard or '' !!}
				</td>
				<td class="top aligned">
					{!! $step->risk_consequence !!}
														<br>
					{!! $step->risk_likelihood !!}
					<br>
					<div class="ui {!! $step->showcolorrisk() !!} segment">
						<br>
					</div>
				</td>
				<td>
					{!! $step->control_measures or '' !!}
				</td>
				<td class="top aligned">
					{!! $step->residual_likelihood !!}<br>
					{!! $step->residual_consequence !!}
				</td>
			</tr>
		@endforeach
	@endif
</table>


@endsection
