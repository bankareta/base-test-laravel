@extends('mails.header',[
	'title' => " ".$title,
	'link' => '',
	'subtitle' => isset($subtitle) ? $subtitle : ''
])
@section('body')
	<table style="font-size: 12px;border-collapse: collapse;">
		<thead class="text-pull-left">
			<tr>
				<th colspan="6" class="bg-bluegray" align="center">Employee completes this section</th>
			</tr>
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
				<div style="clear: both;"></div>
	</div>
	@if($record->published >= 2)
		<br>
		<table style="font-size: 12px;border-collapse: collapse;" width="100%">
			<thead class="text-pull-left">
				<tr>
					<th class="bg-bluegray" align="center">Supervisor completes this section</th>
				</tr>
			</thead>
		</table>
		<div class="row mt-5 pt-5">
			
				<div class="rdg-expertise-category"><span>Hazard Control Action Plan :</span></div><br>
					<p style="font-size: 11px" class="font-color">
						{!! $record->monitoring->planning or '' !!}
					</p>
		</div>
		<hr>
		<table style="font-size: 12px;border-collapse: none;" width="100%">
			<thead class="text-pull-left">
				<tr>
					<th valign="middle" rowspan="3">Hazard Rating :</th>
					<td>
						@if($record->monitoring->rating == 2)
							<img src="http://supreme.pragmainf.tech/public/img/email/checked.png" height="12px">
						@else
							<img src="http://supreme.pragmainf.tech/public/img/email/unchecked.png" height="12px">
						@endif
						Major
					</td>
					<td colspan="2">Potential to cause death, critical injury, or lost time</td>
				</tr>
				<tr>
					<td>
						@if($record->monitoring->rating == 1)
							<img src="http://supreme.pragmainf.tech/public/img/email/checked.png" height="12px">
						@else
							<img src="http://supreme.pragmainf.tech/public/img/email/unchecked.png" height="12px">
						@endif
						Moderate
					</td>
					<td colspan="2">Potential to cause injury requiring medical attention</td>
				</tr>
				<tr>
					<td>
						@if($record->monitoring->rating == 0)
							<img src="http://supreme.pragmainf.tech/public/img/email/checked.png" height="12px">
						@else
							<img src="http://supreme.pragmainf.tech/public/img/email/unchecked.png" height="12px">
						@endif
						Moderate
					</td>
					<td colspan="2">Potential to cause injury requiring first aid</td>
				</tr>
			</thead>
		</table>
	@endif
	@if($record->published >= 3)
		<br>
		<div class="row mt-5 pt-5">
				<div class="rdg-expertise-category"><span>Corrective Action (filled by Dept. in charge) :</span></div>
					<p style="font-size: 11px" class="font-color">
						{!! $record->monitoring->act->action or '' !!}
					</p>
		</div>
		<hr>
		<table style="font-size: 12px;border-collapse: none;" width="100%">
			<thead class="text-pull-left">
				<tr class="bg-bluegray">
					<th>Name :</th>
					<th>Department :</th>
					<th>Date :</th>
				</tr>
				<tr>
						<td>{!! $record->department->person->display or '' !!}</td>
						<td>{!! $record->department->name or '' !!}</td>
						<td>
								{!! $record->monitoring ? ($record->monitoring->act ? Helpers::DateToString($record->monitoring->act->date) : '') : '' !!}
						</td>
				</tr>
			</thead>
		</table>
	@endif
	<hr>
@endsection
