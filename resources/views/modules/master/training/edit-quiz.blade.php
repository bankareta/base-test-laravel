@extends('layouts.form')

@section('css')
	<link rel="stylesheet" href="{{ asset('plugins/semanticui-calendar/calendar.min.css')}}">
@append

@section('js')
	<script src="{{ asset('plugins/semanticui-calendar/calendar.min.js')}}"></script>
@append

@section('scripts')
<script type="text/javascript">
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
	    var hash = window.location.hash;
	    var tab = hash.substr(1)
	    $('.ui.tabular .item[data-tab="'+ tab +'"]').trigger('click');
		$.ajax({
			url: '{{ url($pageUrl.'check-all-quiz/'.$record->id) }}',
			type: "GET",
			success: function(resp){
				$('#input-user').html(resp);
				checkedusers();
				uncheckedusers();
			},
			error : function(resp){
			},
		})
	})

    var loading = `<div class="ui active inverted dimmer">
                    <div class="ui small text loader">Uploading... wait for a while..</div>
                </div>`;

	$(document).ready(function () {
		var showuserurl = '{{ url($pageUrl.'show-users-quiz/'.$record->id) }}';
		loadUsers(showuserurl);
	})

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
				$.ajax({
					url: '{{ url($pageUrl.'check-all-quiz/'.$record->id) }}',
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
		console.log()
		$('input.mfschecked').each(function (index, element) {
			var checkexist = $('input[name="participant[]"][value='+element.value+']').length;
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
		var url = "{{ url('master/training/show-users-quiz/'.$record->id.'?page=1')  }}";
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
	});

	var resetpart = function () {
		$('.resetparticipant.button').on('click', function (e) {
			e.preventDefault();
			$('[name="filters[name]"]').val('');
			$('[name="filters[roles]"]').dropdown('clear');
			$('[name="filters[site]"]').dropdown('clear');
			var url = "{{ url('master/training/show-users-quiz/'.$record->id.'?page=1')  }}";
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
	$('.ui.embed').embed();
</script>
@include('scripts.mfs-js')
@include('modules.master.training.script.function')
@append

@section('content-body')
	<form class="ui data form" id="dataForm" action="{{ url($pageUrl.'edit-quiz/') }}" method="POST">
		<div class="ui top attached segment">
			<div class="ui form">
				{!! csrf_field() !!}
				<input type="hidden" name="id" value="{{ $record->id }}">
				<div class="ui top attached tabular menu">
					<a class="active item" data-tab="first">Training Detail</a>
					<a class="item" data-tab="second">Training File</a>
					<a class="item" data-tab="three">Training Setting</a>
					<a class="item" data-tab="four">Participant</a>
				</div>
				<div class="ui attached active tab segment" data-tab="first">
					@include('modules.master.training.tab.detail-edit')
				</div>
				<div class="ui attached tab segment" data-tab="second">
					<table class="ui celled table">
					    <tbody>
							<tr>
								<td class="fifteen wide">
									<div class="field">
					            <label>Reference Files</label>
					            <div class="ui action input">
					              <input type="text" name="fileupload" placeholder="Search..." readonly>
					              <input type="file" style="display:none !important;" accept="image/*, video/mp4, application/pdf, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/msword, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.ms-excel, application/vnd.ms-powerpoint" multiple>
					              <button class="ui button browse file">Cari..</button>
					            </div>
					          </div>
					        <div class="field showbrowse file">
					          @if($record->files->count() > 0)
					            @foreach($record->files as $file)
					              <div class="two fields bedebahs-file">
					                <div class="fourteen wide field">
					                  <div class="ui progress success" data-percent="100">
					                    <div class="bar" style="transition-duration: 300ms; width: 100%;">
					                      <div class="progress">100%</div>
					                    </div>
					                    <div class="label">{!! $file->filename !!}</div>
					                  </div>
					                </div>
					                <div class="two wide field">
					                  <a href="{{ asset('storage/'.$file->fileurl) }}" target="_blank" download="{{ $file->filename }}" class="ui icon green button">
					                    <i class="download icon"></i>
					                  </a>
					                  <button class="ui icon red removebrowse button" data-url="{{ url('master/training/unlink-file/'.$file->id) }}">
					                    <i class="trash icon"></i>
					                  </button>
					                </div>
					              </div>
					              @endforeach
					            @endif
					        </div>
								</td>
							</tr>
							<tr>
								<td class="fifteen wide">
									<div class="field">
										<label>Embed Youtube : <small style="color: red !important;"><i>https://www.youtube.com/watch?v=FYb1Jlq4XU4</i></small><label>
										<input type="text" name="youtube_url" placeholder="e.g: https://www.youtube.com/watch?v=FYb1Jlq4XU4" value="{{ $record->youtube_url or '' }}">
									</div>
								</td>
							</tr>
							{{-- <tr>
								<td class="fifteen wide">
									<div class="field">
										<label>Website Url : <small style="color: red !important;"><i>https://www.supreme-energy.com</i></small><label>
										<input type="text" name="website_url" placeholder="e.g: https://www.supreme-energy.com" value="{{ $record->website_url or '' }}">
									</div>
								</td>
							</tr> --}}
						</tbody>
					</table>
					<div class="ui two column grid">
						<div class="left aligned column">
							<div class="ui labeled icon button next" data-prev="second" data-tab="first">
							  <i class="chevron left icon"></i>
							  Back
							</div>
						</div>
						<div class="right aligned column">
							<div class="ui right labeled icon button next" data-prev="second" data-tab="three">
							  Next
							  <i class="chevron right icon"></i>
							</div>
						  </div>
					  </div>
				</div>
				<div class="ui attached tab segment" data-tab="three">
					@include('modules.master.training.tab.setting-edit')
				</div>
				<div class="ui attached tab segment" data-tab="four">
					<div class="three fields">
					    <div class="field">
					        <input type="text" name="filters[name]" placeholder="Name">
					    </div>
					    <div class="field">
					        <select name="filters[roles]" class="ui search selection dropdown">
					            {!! \App\Models\Authentication\Role::options('name', 'id', [], 'Choose Roles') !!}
					        </select>
					    </div>
					    <div class="field">
					        <select name="filters[site]" class="ui search selection dropdown">
					            {!! \App\Models\Master\Site::options('name', 'id', [], 'Choose Company') !!}
					        </select>
					    </div>
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
					<div class="ui two column grid">
						<div class="left aligned column">
							<div class="ui labeled icon button next" data-prev="four" data-tab="three">
							  <i class="chevron left icon"></i>
							  Back
							</div>
						</div>
						<div class="right aligned column">
							<div class="ui positive right labeled icon save as page button">
								Save
								<i class="checkmark icon"></i>
							</div>
						</div>
					  </div>
				</div>
			</div>
		</div>
	</form>
@endsection
