@extends('layouts.list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
@append

@section('js')
    <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>
@append

@section('filters')
	<div class="field">
		<input type="text" name="filter[name]" placeholder="Roles">
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
@endsection

@section('rules')
	<script type="text/javascript">
		formRules = {
			username: 'empty',
			email: 'empty',
			roles: 'empty',
		};
	</script>
@endsection

@section('init-modal')
	<script>
        onShow = function(){
            $('.checkbox').checkbox();
            $('.ui.dropdown').dropdown({
                onChange: function(value) {
                    var target = $(this).dropdown();
                    if (value!="") {
                        target
                            .find('.dropdown.icon')
                            .removeClass('dropdown')
                            .addClass('delete')
                            .on('click', function() {
                                target.dropdown('clear');
                                $(this).removeClass('delete').addClass('dropdown');
                                return false;
                            });
                    }
                }
            });
            // force onChange  event to fire on initialization
            $('.ui.dropdown')
                .closest('.ui.selection')
                .find('.item.active').addClass('qwerty').end()
                .dropdown('clear')
                    .find('.qwerty').removeClass('qwerty')
                .trigger('click');

	        $('[name=display_name]').on('change, keyup', function(event) {
	            var display_name = $(this).val();
	            $('[name=name]').val(slugify(display_name));
	        });

            return false;
        };
	</script>
@endsection
@section('toolbars')
    @can($pagePerms.'-add')
        <button type="button" class="ui blue  button add">
            <i class="add icon"></i>
            Create Roles
        </button>
    @endcan
@endsection