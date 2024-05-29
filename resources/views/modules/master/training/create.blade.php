@extends('layouts.form')

@section('css')
	<link rel="stylesheet" href="{{ asset('plugins/semanticui-calendar/calendar.min.css')}}">
@append

@section('js')
	<script src="{{ asset('plugins/semanticui-calendar/calendar.min.js')}}"></script>
@append

@section('scripts')
<script type="text/javascript">
	var showuserurl = '{{ url($pageUrl.'show-users') }}';
	$('.ui.tabular .item').tab();
	$('.ui.tabular .item').tab({
	    onLoad: function (e) {
	        window.location.hash = e;
	    },
	});

	$('.ui.pagination.right.menu a.item').on('click', function (element) {
	    element.preventDefault();
	    var hash = window.location.hash;
	    var href = $(this).attr('href') + hash;

	    window.location = href;
	});
	$(document).ready(function () {
			$('select[name="site_id"]').parents('.ui.dropdown:first').find('.icon.delete').trigger('click');
	    var hash = window.location.hash;
	    var tab = hash.substr(1)
	    $('.ui.tabular .item[data-tab="'+ tab +'"]').trigger('click');

			$('select[name="site_id"]').change(function () {
					showuserurl = '{{ url($pageUrl.'show-users') }}/0/' + $(this).val();
					$('input[name="userchecked[]"]').each(function (index, element) {
							$(element).parents('.ui.checkbox').checkbox('set unchecked');
					})
					$('input[name="participant[]"]').each(function (index, element) {
							$(element).remove();
					})
					loadUsers(showuserurl);
			})

			loadUsers(showuserurl);
	})

    var loading = `<div class="ui active inverted dimmer">
                    <div class="ui small text loader">Uploading... wait for a while..</div>
                </div>`;


	var loadUsers = function (url) {
		$.ajax({
			url: url,
			type: "GET",
			beforeSend : function () {
				$('#show-users').html(loading);
			},
			success: function(resp){
				$('#show-users').html(resp);
				showUsers();
				checkedusers();
				alluserschecked();
				uncheckedusers();
				resetpart();
			},
			error : function(resp){
			},
		})
	}

	var alluserschecked = function () {
		$('[name="all_users"]').parents('.ui.checkbox').checkbox({
			onChecked: function () {
				var site_id = $('select[name="site_id"]').val();

				$.ajax({
					url: '{{ url($pageUrl.'check-all/0') }}/' + site_id,
					type: "GET",
					success: function(resp){
						$('#input-user').html(resp);
						checkedusers();
						uncheckedusers();
					},
					error : function(resp){
					},
				})
			},
			onUnchecked: function () {
				$('#input-user').html('');
				uncheckedusersDUo();
			}
		})
	}

	var checkedusers = function () {
		$('input[name="userchecked[]"]').each(function (index, element) {
			var checkexist = $('input[name="participant[]"][value="'+element.value+'"]').length;
			if(checkexist > 0)
			{
				$(element).parents('.ui.checkbox').checkbox('set checked');
			}
		})
	}

	var uncheckedusers = function () {
		$('.userchecked').checkbox({
			onChecked: function () {
				var val = $(this).val();
				var checkexist = $('input[name="participant[]"][value="'+ val +'"]').length;
				if(checkexist == 0)
				{
					$('#input-user').append(`<input type="hidden" name="participant[]" value="`+ val +`">`);
				}

				var existchecked = $('input[name="userchecked[]"]').parents('.ui.checkbox.checked').length;
				var allchecked = $('input[name="userchecked[]"]').length;
				if(existchecked == allchecked)
				{
					$('[name="all_users"]').parents('.ui.checkbox').checkbox('set checked');
				}
			},
			onUnchecked: function () {
				var val = $(this).val();
				$('input[name="all_users"]').parents('.ui.checkbox').checkbox('set unchecked');
				$('input[name="participant[]"][value="'+ val +'"]').remove();
			}
		})
	}

	var uncheckedusersDUo = function () {
		$('input[name="userchecked[]"]').each(function (index, element) {
			$(element).parents('.ui.checkbox').checkbox('set unchecked');
		})
	}

	$('.filterparticipant.button').on('click', function (e) {
		e.preventDefault();
		var url = showuserurl + '/?page=1';
		var name = $('input[name="filters[name]"]').val();

		if(name)
		{
			url += '&name=' + name;
		}

		var roles = $('select[name="filters[roles]"]').val();

		if(roles)
		{
			url += '&roles=' + roles;
		}
		var site = $('select[name="filters[site]"]').val();

		if(site)
		{
			url += '&site=' + site;
		}

		loadUsers(url);
	})

	var resetpart = function () {
		$('.resetparticipant.button').on('click', function (e) {
			e.preventDefault();
			$('[name="filters[name]"]').val('');
			$('[name="filters[roles]"]').dropdown('clear');
			$('[name="filters[site]"]').dropdown('clear');
			var url = showuserurl + '/?page=1';
			loadUsers(url);
		})
	}

	var showUsers = function () {
		$('.ui.pagination .item').on('click', function (e) {
			e.preventDefault();
			var url = $(this).attr('href');
			$.ajax({
				url: url,
				type: "GET",
				beforeSend : function () {
					$('#show-users').html(loading);
				},
				success: function(resp){
					$('#show-users').html(resp);
					showUsers();
					alluserschecked();
					checkedusers();
					uncheckedusers();
				},
				error : function(resp){
				},
			})
		});
	}
</script>
@include('scripts.mfs-js')
@append

@section('content-body')
	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		<div class="ui top attached segment">
			<div class="ui form">
				{!! csrf_field() !!}
				<div class="ui top attached tabular menu">
					<a class="active item" data-tab="first">Course Detail</a>
					<a class="item" data-tab="three">Course Participant</a>
				</div>
				<div class="ui attached active tab segment" data-tab="first">
					<input type="hidden" name="status" value="0">
					<div class="field">
						<label>Title</label>
						<input type="text" name="title" placeholder="Title">
					</div>
					<div class="field">
						<label>Contents</label>
						<textarea name="contents" placeholder="Contents"></textarea>
					</div>
					<div class="field">
						<label>Company</label>
						<select name="site_id" class="ui search selection dropdown">
							{!! \App\Models\Master\Site::options('name', 'id', ['filters' => [
							function ($site) {
									$site->whereIn('id', auth()->user()->site->pluck('id')->toArray());
								},
							]
						], 'Choose Company') !!}
						</select>
					</div>
					<div class="field">
						<label>Type Training</label>
						<select name="type_training_id" class="ui search selection dropdown">
							{!! \App\Models\Master\TypeTraining::options('name', 'id', [], 'Choose Type Training') !!}
						</select>
					</div>
				</div>
				<div class="ui attached tab segment" data-tab="three">
					<div class="two fields">
						<div class="field">
							<input type="text" name="filters[name]" placeholder="Name">
						</div>
						<div class="field">
							<select name="filters[roles]" class="ui search selection dropdown">
								{!! \App\Models\Authentication\Role::options('name', 'id', [], 'Choose Roles') !!}
							</select>
						</div>
						{{-- <div class="field">
							<select name="filters[site]" class="ui search selection dropdown">
								{!! \App\Models\Master\Site::options('name', 'id', [], 'Choose Company') !!}
							</select>
						</div> --}}
						<button type="button" class="ui teal icon filterparticipant button" data-content="Search Data">
							<i class="search icon"></i>
						</button>
						<div class="ui icon resetparticipant button" data-content="Clear Search">
							<i class="refresh icon"></i>
						</div>
					</div>
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="checkbox" name="all_users">
							<label><b>Select All User</b></label>
						</div>
					</div>
					<div class="ui divider"></div>
					<div id="show-users"></div>
					<div id="input-user"></div>
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
				<div class="right aligned column">
		            <div class="ui positive right labeled icon save as page button">
		                Save
		                <i class="checkmark icon"></i>
		            </div>
				</div>
			</div>
		</div>
	</form>
@endsection
