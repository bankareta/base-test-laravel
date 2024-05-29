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

@section('scripts')
<script>
	$(document).ready(function () {
		append();
	});
	initModal = function () {

	}
	var append = function () {
		$(document).on('click', '.add-content', function(e){
			$('#showOther').append(`
			<div class="fields">
				<div class="four wide field">
					<input type="text" name="abbreviation[]" placeholder="Abbreviation">
					</div>
				<div class="twelve wide field">
					<div class="ui action input">
						<input type="text" name="component[]" placeholder="Component">
						<button type="button" class="ui red icon button remove-content">
						<i class="trash icon"></i>
						</button>
					</div>
				</div>
			</div>
			`);
		});

		$(document).on('click', '.remove-content', function(e){
			$(this).parents('div.fields:first').remove();
		});
	}
</script>
@endsection
