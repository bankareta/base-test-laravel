@extends('mails.header',[
	'title' => " ".$title,
	'link' => $urls,
	'subtitle' => isset($subtitle) ? $subtitle : ''
	])
	@section('body')
	<style>
</style>
<b style="font-size: 16px;">{!! $record->title !!}</b> <small style="color: gray;font-size:10px;"> by :<u style="color : gray;"> {!! $record->entryBy() !!} </u> &nbsp; at : <i>{!! ($record->updated_at !== null ? Helpers::DateToString($record->updated_at) : Helpers::DateToString($record->created_at)) !!}</i></small>
<hr>
<div class="row mt-5 pt-5">
		<div class="rdg-expertise-description">
			{{-- <p style="font-size: 11px" class="font-color"> --}}
				{!! $record->content or '' !!}
			{{-- </p> --}}
			{{-- <div style="clear: both;"></div> --}}
		</div>
</div>
<br>
{{-- <table style="font-size: 12px;border-collapse: collapse;" width="100%">
	<thead class="text-pull-left">
		@if($record->lampiranberkas->count() > 0)
			<tr>
				<th valign="top" width="10%">Atachment</th>
				<th valign="top" width="5%">:</th>
				<th class="font-color">
					@foreach($record->lampiranberkas as $lampiran)
						<a href="{!! asset('storage/'.$lampiran->url) !!}" target="_blank">{!! $lampiran->filename !!}</a><br>
					@endforeach
				</th>
			</tr>
		@endif
    </thead>
</table> --}}

@endsection
