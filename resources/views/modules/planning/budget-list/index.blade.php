@extends('layouts.list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
@append

@section('js')
    <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>
@append

@section('filters')
<div class="field">
	<input type="text" name="filter[Visitor]"  placeholder="List" value="">
</div>

<button type="button" class="ui teal icon filter button" data-content="Cari Data">
	<i class="search icon"></i>
</button>
<button type="reset" class="ui icon reset button" data-content="Bersihkan Pencarian">
	<i class="refresh icon"></i>
</button>
@endsection

@section('js-filters')
d.visitor = $("input[name='filter[visitor]']").val();
@endsection

@section('toolbars')
	   <button type="button" class="ui blue @if($pagePerms != '' && !auth()->user()->can($pagePerms.'-add')) disabled @endif button add">
            <i class="add icon"></i>
            Create New Data
        </button>
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
  initModal = function(){
	$('.add-child').on('click', function(e){
		parent = $('#show-child');
		len = $('.child-data').lenght;
		htm = `
			<div class="two fields child-data">
				<div class="field">
					<label>List</label>
					<input type="text" name="child_name[]" placeholder="List">
				</div>
				<div class="field">
					<label>Real Budget</label>
					<input type="number" name="child_budget[]" placeholder="Real Budget">
				</div>
			</div>
		`;
		parent.append(htm);
	});
}
</script>
@endsection
