@extends('layouts.list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
@append

@section('js')
    <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>
@append

@section('filters')
<div class="field">
		<div class="ui input left icon">
			<i class="search icon"></i>
			<input type="text" name="filter[material_name]"  placeholder="Title" value="">
		</div>
</div>

<button type="button" class="ui teal icon filter button" data-content="Find Data">
	<i class="search icon"></i>
</button>
<button type="reset" class="ui icon reset button" data-content="Clear Search">
	<i class="refresh icon"></i>
</button>
@endsection

@section('js-filters')
d.material_name = $("input[name='filter[material_name]']").val();
@endsection


@section('rules')
<script type="text/javascript">
</script>
@endsection

@section('toolbars')
	@can($pagePerms.'-add')
		<button type="button" class="ui gmf blue add button">
			<i class="plus icon"></i>
			Create New Data
		</button>
	@endcan
@endsection
