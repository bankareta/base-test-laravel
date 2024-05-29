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
			<input type="text" name="filter[name]"  placeholder="Name" value="">
		</div>
</div>

<button type="button" class="ui teal icon filter button" data-content="Find Data">
	<i class="search icon"></i>
</button>
<button type="reset" class="ui icon reset button" data-content="Clear Search">
	<i class="refresh icon"></i>
</button>
@endsection

@section('init-modal')
<script>

	initModal = function(){
		$('.date').calendar({
					type: 'date',

			});
	}
</script>
@append

@section('js-filters')
d.name = $("input[name='filter[name]']").val();
d.status = $("select[name='filter[status]']").val();
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
