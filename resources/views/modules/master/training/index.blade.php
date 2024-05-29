@extends('layouts.list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
@append

@section('js')
    <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>
@append

@section('filters')
	<div class="field">
		<input type="text" name="filter[title]" placeholder="Title">
	</div>
  <div class="field">
    <select name="filter[type_training_id]" class="ui search selection dropdown">
      {!! \App\Models\Master\TypeTraining::options('name', 'id', [], 'Choose Type Training') !!}
    </select>
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
  d.type = $("select[name='filter[type_training_id]']").val();
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

@section('scripts')
<script type="text/javascript">

function publishedQuiz(url) {
    swal({
        title: 'Published',
        html: "Are you sure you want to publish the data? <br>The data can not be edited after published.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Confirm',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
    }).then((result) => {
        if (result) {
            $('#cover').css('display','');
            $.ajax({
                url: url,
                type: 'POST',
                // dataType: 'json',
                data: {
                    '_method' : 'PUT',
                    '_token' : '{{ csrf_token() }}'
                }
            })
            .done(function(response) {
                $('#cover').css('display','none');
                swal({
                    title: 'Successfully Published',
                    text: " ",
                    type: 'success',
                    allowOutsideClick: false
                }).then((res) => {
                    if(response.url){
                        location.href = '{{ url($pageUrl) }}';
                    }else if(response.redirect){
                        if(response.redirect != '-'){
                            showData(response.redirect);
                            window.history.pushState("", "");
                        }else{
                            location.href = '{{ url($pageUrl) }}';
                        }

                    }else{
                        dt.draw('page');
                        return true;
                    }
                })
            })
            .fail(function(response) {
                $('#cover').css('display','none');
                swal({
                    title: 'Failed to Delete',
                    text: " ",
                    type: 'error',
                    allowOutsideClick: false
                }).then((res) => {

                })
            })

        }
    })
}

function deleteQuiz(url) {
    swal({
        title: 'Delete Data',
        html: "Are you sure you want to delete the data? <br>The data can not be returned.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Confirm',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
    }).then((result) => {
        if (result) {
            $('#cover').css('display','');
            $.ajax({
                url: url,
                type: 'POST',
                // dataType: 'json',
                data: {
                    '_method' : 'DELETE',
                    '_token' : '{{ csrf_token() }}'
                }
            })
            .done(function(response) {
                $('#cover').css('display','none');
                swal({
                    title: 'Successfully Deleted',
                    text: " ",
                    type: 'success',
                    allowOutsideClick: false
                }).then((res) => {
					dt.draw();
					return true;
                })
            })
            .fail(function(response) {
                $('#cover').css('display','none');
                swal({
                    title: 'Failed to Delete',
                    text: " ",
                    type: 'error',
                    allowOutsideClick: false
                }).then((res) => {

                })
            })

        }
    })
}
</script>
@append
