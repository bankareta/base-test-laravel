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
					<h3>Created By : {{ $record->creator->display or '' }}</h3>
				</p>
			</th>
			<th colspan="3" class="text-pull-right">
				<p>
					<h3>Due Date : {{ $record->tanggal_berakhir or '' }}</h3>
				</p>
			</th>
		</tr>	
	</thead>
	<thead class="text-pull-left">	
		<tr>
			<th>Certificate Number</th>
			<th>:</th>
			<th class="font-color" style="width: 220px">{{ $record->no_sertifikat or '' }}</th>
		</tr>
		<tr>
			<th>Equipment Type</th>
			<th>:</th>
			<th class="font-color">{{ $record->type->name or '' }}</th>
		</tr>
		<tr>
			<th>Register Number</th>
			<th>:</th>
			<th class="font-color">{{ $record->register_number or '' }}</th>
		</tr>
		<tr>
			<th>Brand</th>
			<th>:</th>
			<th class="font-color">{{ $record->merek or '' }}</th>
		</tr>
		<tr>
			<th>Company</th>
			<th>:</th>
			<th class="font-color">{{ $record->company->name or '' }}</th>
		</tr>
		<tr>
			<th>Equipment Name </th>
			<th>:</th>
			<th class="font-color"><p>{!! $record->name or '' !!}</p></th>
		</tr>
</thead>
</table>
<div class="row mt-5 pt-5">
	
		
		<div class="rdg-expertise-category"><span>Description :</span></div><br>
			<p style="font-size: 11px" class="font-color">
				{!! $record->description or '' !!}
			</p>

</div>

@endsection