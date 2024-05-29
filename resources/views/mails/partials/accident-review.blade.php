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
					<h3>Report No : <u style="color : #E8210E;">{!! $record->incident_number or '' !!}</u></h3>
				</p>
			</th>
			<th colspan="3" class="text-pull-right">
				<p>
                    <h3>Reported By : <u style="color : #E8210E;">{!! $record->investigationrequest->display or '' !!}</u></h3>
				</p>
			</th>
		</tr>
		<tr>
			<th>Date</th>
			<th>:</th>
			<th class="font-color" style="width: 220px">{{ $record->date_of_incident or '' }}</th>

			<th>Name Of Supervisor</th>
			<th>:</th>
			<th class="font-color">{!! $record->reviewedby->display or '' !!}</th>

		</tr>
		<tr>
			<th>Company</th>
			<th>:</th>
			<th class="font-color">{!! $record->site->name or '' !!}</th>

			<th>Location</th>
			<th>:</th>
			<th class="font-color">{!! $record->incident_location or '' !!}
            </th>
		</tr>
    </thead>
</table>
<table style="font-size: 12px;border-collapse: collapse;">
	<thead class="text-pull-left">
		<tr>
			<th colspan="6">
				<p>
					<h3>I. GENERAL INFORMATION</u></h3>
				</p>
			</th>
		</tr>
		<tr>
			<th>Type of Incident</th>
			<th>:</th>
			@if ($record->type_of_incident == 0)
				<th class="font-color" style="width: 220px">ON THE JOB</th>
			@else
				<th class="font-color" style="width: 220px">OFF THE JOB</th>
			@endif
			<th>Incident Type</th>
			<th>:</th>
			@if(isset($record->incidenttype))
				@foreach ($record->incidenttype as $data)
					<th class="font-color" >{!! $data->name or '' !!}</th>
				@endforeach
			@else
				<th class="font-color">{!! $record->other_incident_type or '' !!}</th>
			@endif
		</tr>
		<tr>
			<th>Actual Loss Severity</th>
			<th>:</th>
			@switch($record->actual_loss)
			    @case(0)
					<th class="font-color" style="width: 220px">MAJOR</th>
			        @break
				@case(1)
					<th class="font-color" style="width: 220px">SERIOUS</th>
			        @break
		        @case(2)
					<th class="font-color" style="width: 220px">MODERATE</th>
			        @break
			    @case(3)
					<th class="font-color"style="width: 220px">MINOR</th>
			        @break    
			@endswitch
			<th>Potential Loss Severity</th>
			<th>:</th>
			@switch($record->potential_loss)
			    @case(0)
					<th class="font-color" >MAJOR</th>
			        @break
				@case(1)
					<th class="font-color" >SERIOUS</th>
			        @break
		        @case(2)
					<th class="font-color" >MODERATE</th>
			        @break
			    @case(3)
					<th class="font-color" >MINOR</th>
			        @break   
			@endswitch
		</tr>
		<tr>
			<th>Probability of Reccurence</th>
			<th>:</th>
			@switch($record->probability)
			    @case(0)
					<th class="font-color" >FREQUENT</th>
			        @break
				@case(1)
					<th class="font-color" >OCCASIONAL</th>
			        @break
		        @case(2)
					<th class="font-color" >SELDOM</th>
			        @break
			    @case(3)
					<th class="font-color" >RARE</th>
			        @break   
			@endswitch
		</tr>
    </thead>
</table>
<table style="font-size: 12px;">
	<thead class="text-pull-left">
		<tr>
			<th colspan="6">
				<p>
					<h3>II. FACTUAL INFORMATION</u></h3>
				</p>
			</th>
		</tr>
    </thead>
    <tbody style="text-align: left;border: solid 1px;">
    	<tr>
    		<th>
    			<p style="font-size: 11px" class="font-color">
	                {!! $record->factual_information or '' !!}
				</p>
    		</th>
    	</tr>
    	<tr>
    		<th>
    			<span>Cost Estimate :</span>
    			<br>
    			<p style="font-size: 11px" class="font-color">
	                {!! $record->cost_estimate or '' !!}
				</p>
    		</th>
    	</tr>
    </tbody>
</table>

<table style="font-size: 12px;">
	<thead class="text-pull-left">
		<tr>
			<th colspan="6">
				<p>
					<h3>III. IMMEDIATE ACTIONS</u></h3>
				</p>
			</th>
		</tr>
    </thead>
    <tbody style="text-align: left;border: solid 1px;">
    	<tr>
    		<th>
    			<p style="font-size: 11px" class="font-color">
	                {!! $record->immediate_actions or '' !!}
				</p>
    		</th>
    	</tr>
    </tbody>
</table>
<table style="font-size: 12px;">
	<thead class="text-pull-left">
		<tr>
			<th colspan="6">
				<p>
					<h3>IV. INCIDENT MECHANISM OR SEQUENT OF EVENT</u></h3>
				</p>
			</th>
		</tr>
    </thead>
    <tbody style="text-align: left;border: solid 1px;">
    	<tr>
    		<th>
    			<p style="font-size: 11px" class="font-color">
	                {!! $record->incident_mechanism or '' !!}
				</p>
    		</th>
    	</tr>
    </tbody>
</table>

<table style="font-size: 12px;">
	<thead class="text-pull-left">
		<tr>
			<th colspan="6">
				<p>
					<h3>V. DATA & INVESTIGATION ANALYSIS</u></h3>
				</p>
			</th>
		</tr>
    </thead>
    <tbody style="text-align: left;border: solid 1px;">
    	<tr>
    		<th>
    			<p style="font-size: 11px" class="font-color">
	                {!! $record->data_investigations or '' !!}
				</p>
    		</th>
    	</tr>
    </tbody>
</table>

<table style="font-size: 12px;">
	<thead class="text-pull-left">
		<tr>
			<th colspan="6">
				<p>
					<h3>VI. ROOT CAUSE & IMMEDIATE CAUSE</h3>
				</p>
			</th>
		</tr>
    </thead>
    <tbody style="text-align: left;border: solid 1px;">
    	<tr>
    		<th>
    			<p style="font-size: 11px" class="font-color">
	                {!! $record->root_cause or '' !!}
				</p>
    		</th>
    	</tr>
    </tbody>
</table>

<table style="font-size: 12px;">
	<thead class="text-pull-left">
		<tr>
			<th colspan="6">
				<p>
					<h3>VII. SUMMARY OF INVESTIGATION</u></h3>
				</p>
			</th>
		</tr>
    </thead>
    <tbody style="text-align: left;border: solid 1px;">
    	<tr>
    		<th>
    			<p style="font-size: 11px" class="font-color">
	                {!! $record->summary or '' !!}
				</p>
    		</th>
    	</tr>
    </tbody>
</table>

<table style="font-size: 12px;">
	<thead class="text-pull-left">
		<tr>
			<th colspan="6">
				<p>
					<h3>VIII. RECOMMENDATION & ACTION PLAN</u></h3>
				</p>
			</th>
		</tr>
    </thead>
    {{-- <tbody style="text-align: left;border: solid 1px;">
    	<tr>
    		<th>
    			<p style="font-size: 11px" class="font-color">
	                {!! $record->recommendation or '' !!}
				</p>
    		</th>
    	</tr>
    </tbody> --}}
</table>

@endsection
