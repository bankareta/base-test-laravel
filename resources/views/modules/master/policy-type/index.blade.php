@extends('layouts.list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
@append

@section('js')
    <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>
@append

@section('filters')
	<div class="field">
		<input type="text" name="filter[name]" placeholder="Policy & Procedure Type">
	</div>
	<button type="button" class="ui teal icon filter button" data-content="Search Data">
		<i class="search icon"></i>
	</button>
	<button type="reset" class="ui icon reset button" data-content="Clear Search">
		<i class="refresh icon"></i>
	</button>
@endsection

@section('js-filters')
  d.name = $("input[name='filter[name]']").val();
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

@section('init-modal')
<script>
	$(document).ready(function() {

	});

</script>
@endsection
