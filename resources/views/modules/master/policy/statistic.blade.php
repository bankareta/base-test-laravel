@extends('layouts.list')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/semanticui-calendar/calendar.min.css')}}">
@append

@section('js')
<script src="{{ asset('plugins/semanticui-calendar/calendar.min.js')}}"></script>
@append

@section('scripts')
@include('modules.master.policy.script.datatable')
<script>
	$(document).ready(function() {
		$('.search.dropdown').addClass('six wide column')

  	$('.summernote').summernote('disable', {
  	  height: 500,   //set editable area's height
  	  codemirror: { // codemirror options
  	    theme: 'monokai'
  	  },
  		toolbar: [
  		 // [groupName, [list of button]]
  		 ['style', ['bold', 'italic', 'underline', 'clear']],
  		 ['font', ['strikethrough', 'superscript', 'subscript']],
  		 ['fontsize', ['fontsize']],
  		 ['color', ['color']],
  		 ['para', ['ul', 'ol', 'paragraph']],
  		 ['height', ['height']]
  	 ],
  	})
	});
</script>
@append

@section('content-header')
<h2 class="ui header">
	<div class="content">
		Detil {!! $title or '' !!}
	</div>
</h2>
@endsection

@section('content-body')
<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
	<div class="ui top attached segment">
		<div class="ui grid form">
			<div class="sixteen wide column">
				<h1 class="ui header">
	        <img src="{!! asset('img/icon-long.png') !!}" class="ui circular image">
	        <div class="content">
	          {!! $record->title !!}
	          <div class="sub header">{!! ($record->updated_at != null ? $record->updated_at : $record->created_at) !!} - By : {!! $record->entryBy() !!}</div>
	        </div>
	      </h1>
				<div class="ui divider"></div>
				<form class="ui filter form">
					<div class="inline fields">
						<div class="field">
							<input name="filter[username]" placeholder="username" type="text">
						</div>
						<div class="field">
						  <select name="filter[reviewed]" class="ui search dropdown">
						    <option value="">(Choose view status)</option>
						    <option value="1">Already viewed</option>
						    <option value="0">Not yet viewed</option>
						  </select>
						</div>
						<button type="button" class="ui icon filter button" data-content="Cari Data">
							<i class="search icon"></i>
						</button>
						<button type="reset" class="ui icon reset button" data-content="Bersihkan Pencarian">
							<i class="refresh icon"></i>
						</button>
						<div class="field" style="padding-left: 50px">
							<h5 class="ui header">Not yet viewed = {!! $record->getNotReviewedCount()  !!}</h5>
						</div>
						<div class="field">
							<h5 class="ui header">Already viewed = {!! $record->getReviewedCount()  !!}</h5>
						</div>
						<div class="field">
							<h5 class="ui header">Total = {!! App\Models\Authentication\User::whereHas('site', function ($site) use ($record) {
					        $site->whereIn('id', $record->site->pluck('id'));
					    })->count()  !!}</h5>
						</div>
					</div>
				</form>
				<table id="userTable" class="ui celled compact table" width="100%" cellspacing="0">
					<thead>
						<tr>
							@foreach ($userStruct as $struct)
								<th class="center aligned">{{ $struct['label'] or $struct['name'] }}</th>
							@endforeach
						</tr>
					</thead>
					<tbody>
						@yield('tableBody')
					</tbody>
				</table>
      </div>
		</div>
	</div>
	<div class="ui botttom attached segment">
		<div class="ui two column grid">
			<div class="left aligned column">
				<a class="ui labeled icon button" href="{{ url($pageUrl) }}">
					<i class="chevron left icon"></i>
					Back
				</a>
			</div>
		</div>
	</div>
</form>
@endsection
