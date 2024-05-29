@extends('layouts.form')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/semanticui-calendar/calendar.min.css')}}">
@append

@section('js')
<script src="{{ asset('plugins/semanticui-calendar/calendar.min.js')}}"></script>
@append
@section('scripts')
<script>
	$(document).ready(function() {
		$('.search.dropdown').addClass('six wide column')
	});
</script>
@endsection

@section('content-header')
<h2 class="ui header">
	<div class="content">
		Create a {!! $title !!}
	</div>
</h2>
@endsection

@section('content-body')
<div class="ui icon message">
  <i class="inbox icon"></i>
  <div class="content">
    <div class="header">
      Sorry you cannot create {!! $title !!}?
    </div>
    <p>Please create the {!! $title !!} type first, by <a href="{!! url('master/type-bulletin') !!}">click here.</a></p>
  </div>
</div>
@endsection
