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
					<h3>PIC : {{ $record->pic->first()->user->display or '' }}</h3>
				</p>
			</th>
			<th colspan="3" class="text-pull-right">
				<p>
					<h3>Due Date : {{ $record->detail->due_date or '' }}</h3>
				</p>
			</th>
		</tr>	
		<tr>
			<th>Finding No</th>
			<th>:</th>
			<th class="font-color" style="width: 220px">{{ $record->id_finding or '' }}</th>
			
			<th>Inspected By</th>
			<th>:</th>
			<th class="font-color">{{ $record->inspected->display or '' }}</th>

		</tr>
		<tr>
			<th>Date of Inspection</th>
			<th>:</th>
			<th class="font-color">{{ $record->date_inspection or '' }}</th>
			
			<th>Hazard Category</th>
			<th>:</th>
			<th class="font-color">{{ $record->hazard->name or '' }}</th>
		</tr>
		<tr>
			<th>Company</th>
			<th>:</th>
			<th class="font-color">{{ $record->company->name or '' }}</th>
			
			<th>Location</th>
			<th>:</th>
			<th class="font-color">{{ $record->location or '' }}</th>
		</tr>
		<tr>
			<th>Contractor</th>
			<th>:</th>
			<th class="font-color">{{ $record->contractor_id or '' }}</th>
			
			<th>Department</th>
			<th>:</th>
			<th class="font-color">{{ $record->department->name or '' }}</th>
		</tr>
		<tr>
			<th>SHE Category</th>
			<th>:</th>
			<th class="font-color">{{ $record->she->name or '' }}</th>
			<th>Status</th>
			<th>:</th>
			<th class="font-color">
				@if($record->status == 1)
					<span class="label info">Open</span>
				@elseif($record->status == 2)
					<span class="label warning">On Action</span>
				@else
					<span class="label danger">Done</span>
				@endif
			</th>

	</tr>
</thead>
</table><br>
<div class="row mt-5 pt-5">
	
		<div class="rdg-expertise-category"><span>Nature of Non Compliance :</span></div><br>
		
			<p style="font-size: 11px" class="font-color">
				{!! $record->detail->nature or '' !!}
			</p>
	
</div><br>
<div class="row mt-5 pt-5">
	
		<div class="rdg-expertise-category"><span>Recommendation & Action Plan :</span></div><br>
			<p style="font-size: 11px" class="font-color">
				{!! $record->detail->recommendation or '' !!}
			</p>
	
</div>
@endsection