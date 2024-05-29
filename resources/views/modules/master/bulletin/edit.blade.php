@extends('layouts.form')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/semanticui-calendar/calendar.min.css')}}">
@append

@section('js')
<script src="{{ asset('plugins/semanticui-calendar/calendar.min.js')}}"></script>
@append
@section('scripts')
<script>

$(document).on('click', '.ui.red.icon.button.hapus-file-custom', function(e){
	var id = $(this).data('id');
	var hta = `
		<input type="hidden" name="file_deleted_id[]" placeholder="Title" value="`+id+`">
	`;
	$('.showfile'+id).html('');
	$('.showfile'+id).html(hta);
});

</script>
@endsection

@section('content-header')
<div class="ui breadcrumb">
	<div class="active section"><i class="home icon"></i></div>
	<i class="right chevron icon divider"></i>
	<?php $i=1; $last=count($breadcrumb);?>
	@foreach ($breadcrumb as $name => $link)
	@if($i++ != $last)
	<a href="{{ $link }}" class="section">{{ $name }}</a>
	<i class="right chevron icon divider"></i>
	@else
	<div class="active section">{{ $name }}</div>
	@endif
	@endforeach
</div>
<h2 class="ui header">
	<div class="content">
		{{-- {{trans('translator.Buat')}} {!! trans('translator.'.$title) !!} --}}
		Edit Bulletin & Alert
	</div>
</h2>
@endsection

@section('content-body')
<form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">
	<div class="ui top attached segment">
		<div class="ui form">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<input type="hidden" name="status" value="{{ $record->status }}">
			<div class="two fields">
				<div class="field">
					{{-- <label>{{trans('translator.Judul')}}</label> --}}
					{{-- <input type="text" name="title" placeholder="{{trans('translator.Judul')}}"> --}}
					<label>Title</label>
					<input type="text" name="title" placeholder="Title" value="{{ $record->title or '' }}">
				</div>
				<div class="field">
					<label>Company</label>
					<select id="site_id" name="site_id[]" class="ui fluid search dropdown" multiple>
						{!! App\Models\Master\Site::options('name','id',[
							'filters' => [
								function ($site) {
										$site->whereIn('id', auth()->user()->site->pluck('id')->toArray());
									},
								],
								'selected' => $record->site->pluck('id')->toArray(),
						], 'Choose One') !!}
					</select>
				</div>
			</div>
			<div class="field">
		    {{-- <label>{{trans('translator.Konten')}}</label>
		    <textarea name="content" placeholder="{{trans('translator.Konten')}}" class="summernote"></textarea> --}}
		    <label>Contents</label>
		    <textarea name="content" placeholder="Contents" class="summernote">{!! $record->content or '' !!}</textarea>
		</div>
		<div class="two fields">

			<div class="field">
				{{-- <label>{{trans('translator.Tipe')}} {!! trans('translator.'.$title) !!} {{trans('translator.ini')}}?</label> --}}
				<label>Bulletin & Alert Type</label>
				<select id="site_id" name="type_id" class="ui fluid search dropdown">
					{!! App\Models\Master\TipeBulletin::options('name','id',[
						'selected' => $record->type_id
					], 'Choose One') !!}
				</select>
			</div>

			<div class="field">
				{{-- <label>{{trans('translator.Lampiran')}}</label> --}}
				<label>Attachment</label>
				<div id="lampiran-area">
					@if(isset($record))
					@if(isset($record->lampiranberkas))
					@if($record->lampiranberkas->count() > 0)
					@foreach($record->lampiranberkas as $lampiran)
					<div class="ui inline grid field showfile{{$lampiran->id}}" style="width: 100%">
						<div class="sixteen wide column" style="padding: .5rem 0">
							<div class="fields">
								<input type="text" readonly value="{{ $lampiran->filename or '' }}" data-id="{{ $lampiran->id }}" data-types="bulletin">
								<div class="ui positive icon button download open new page" data-url="{{ url($pageUrl.$lampiran->id.'/download') }}">
									<i class="download icon" style="color: #fff"></i>
								</div>
								<div class="ui red icon button hapus-file-custom" data-id="{{ $lampiran->id }}" >
									<i class="trash icon"></i>
								</div>
							</div>
							@if(isset($record->waktu))
								@if(!is_null($record->waktu))
									@if(isset($record->tanggal) or isset($record->tanggal_akhir))
										@if(!is_null($record->tanggal) or !is_null($record->tanggal_akhir))
											@if($file->taken_at != NULL)
												@if(isset($record->tanggal_akhir))
												{!! stringTakenAt($file->taken_at, $record->waktu, $record->tanggal_akhir) !!}
												@else
												{!! stringTakenAt($file->taken_at, $record->waktu, $record->tanggal) !!}
												@endif
											@endif
										@endif
									@endif
								@endif
							@endif
						</div>
					</div>
					@endforeach
					@endif
					@endif
					@endif
				</div>
				<div class="ui inline grid field" style="width: 100%">
					<div class="sixteen wide column" style="padding: .5rem 0">
						<div class="ui fluid file input action">
							<input type="text" name="attachment_text" readonly>
							<input type="file" class="sixteen wide column"  name="attachment[]" autocomplete="off" multiple>
							<div class="ui button file">
								{{-- {{trans('translator.Cari')}}... --}}
								Search...
							</div>
							{{-- <button type="submit" class="ui button save as publicity teal" style="display:none;">Publish</button> --}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ui botttom attached segment">
	<div class="ui two column grid">
		<div class="left aligned column">
			<div class="ui labeled icon button" onclick="goBack()">
				<i class="chevron left icon"></i>
				{{-- {{trans('translator.Kembali')}} --}}
				Back
			</div>
		</div>
		<div class="right aligned column">
			<div class="ui buttons">
				<button type="button" class="ui button save as draft positive">Draft</button>
				<div class="or"></div>
				<button type="button" class="ui button save as published">Publish</button>
			</div>
		</div>
	</div>
</div>
</form>
@endsection

@section('scripts')
<script type="text/javascript">
var date = new Date();
date.setDate(date.getDate() + 1);

$('.ui.calendar').calendar({
	type: 'date',
	formatter: {
		date: function (date, settings) {
			let momentDate = new moment(date)
			return momentDate.format('DD/MM/YYYY')
		}
	},
	popupOptions: {
		position: 'center',
	},
});
</script>
@append
