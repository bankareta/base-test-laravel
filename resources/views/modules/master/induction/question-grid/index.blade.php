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
		<input type="text" name="filter[material_name]"  placeholder="Question" value="">
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

@section('scripts')
{{-- @include('modules.master.induction.script') --}}
<script>
$(document).on('click', '.red.mfs.remove.pictureexist.button', function(e){
	var elem = $(this);
	var id = $(this).data('id');
	var hta = `
		<input type="hidden" name="file_deleted_id[]" placeholder="Title" value="`+id+`">
	`;
	$('#showFileExistDelete').append(hta);
	elem.parents('.card').remove();
});
</script>
@endsection

@section('rules')
<script type="text/javascript">
</script>
@endsection

@section('toolbars')
	@can($pagePerms.'-add')
		@if ($record->status == 0)
			<button type="button" class="ui gmf blue add button">
				<i class="plus icon"></i>
				Create New Data
			</button>
		@endif
	@endcan
@endsection

@section('bottom-act')
<div class="ui botttom attached segment">
	<div class="ui two column grid">
		<div class="left aligned column">
			<a href="{{ url('master/induction/manage-material') }}/{{ $record->id }}">
				<div class="ui labeled icon button">
					<i class="chevron left icon"></i>
					Back
				</div>
			</a>
		</div>
		<div class="right aligned column">
			
		</div>
	</div>
</div>
@endsection

@section('init-modal')
@include('modules.master.induction.question-grid.script')
@endsection