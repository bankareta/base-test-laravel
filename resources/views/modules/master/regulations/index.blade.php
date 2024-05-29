@extends('layouts.list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
@append

@section('js')
    <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>
@append

@section('filters')
  <div class="field">
    <select name="filter[type_id]" class="ui search dropdown">
      {!! \App\Models\Master\TypeRegulationsStandard::options('name','id',[],'Choose Type') !!}
    </select>
  </div>
  {{-- <div class="field">
    <select name="filter[site_id]" class="ui search dropdown">
      {!! \App\Models\Master\Site::options('name','id',[],'Choose Company') !!}
    </select>
  </div> --}}
  <div class="field">
  	<input name="filter[title]" placeholder="Title" type="text">
  </div>
	<button type="button" class="ui teal icon filter button" data-content="Search Data">
		<i class="search icon"></i>
	</button>
	<button type="reset" class="ui icon reset button" data-content="Clear Search">
		<i class="refresh icon"></i>
	</button>
@endsection

@section('js-filters')
  d.title = $("input[name='filter[title]']").val();
  d.type_id = $("select[name='filter[type_id]']").val();
  d.site_id = $("select[name='filter[site_id]']").val();
@endsection

@section('rules')
<script type="text/javascript">
	formRules = {
		judul: 'empty',
		sub_judul: 'empty',
		url: 'url',
	};
</script>
@endsection

@section('toolbars')
	{{-- @if(auth()->user()->canPerm('master-kelola')) --}}
		<button type="button" class="ui blue add-page button">
			<i class="plus icon"></i>
			Create New Data
		</button>
	{{-- @endif --}}
@endsection
