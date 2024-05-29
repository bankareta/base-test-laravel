@extends('layouts.list')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
<link href="{{ asset('dist/photoviewer.css') }}" rel="stylesheet">
@append

@section('js')
<script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>
<script src="{{ asset('dist/photoviewer.js') }}"></script>
@append

@section('styles')
<style>
    .photoviewer-stage {
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, .85);
        border: none;
    }

    .photoviewer-header .photoviewer-toolbar {
        background-color: rgba(0, 0, 0, .5);
    }

    .photoviewer-footer {
        bottom: 10px;
    }

    .photoviewer-footer .photoviewer-toolbar {
        background-color: rgba(0, 0, 0, .5);
        border-radius: 5px;
    }

    .photoviewer-header,
    .photoviewer-footer {
        pointer-events: none;
    }

    .photoviewer-title {
        color: #ccc;
    }

    .photoviewer-button {
        color: #ccc;
        pointer-events: auto;
    }

    .photoviewer-footer .photoviewer-button:hover {
        color: white;
    }
  </style>
@endsection

@section('scripts')
<script>
    $('[data-gallery=photoviewer]').click(function (e) {
        e.preventDefault();

        var items = [],
        options = {
            index: $(this).index(),
            resizable: false,
            initMaximized: true,
            headerToolbar: ['close'],
        };

        $('[data-gallery=photoviewer]').each(function () {
        items.push({
            src: $(this).attr('href'),
            title: $(this).attr('data-title')
        });
        });

        new PhotoViewer(items, options);
    });
</script>
@endsection

@section('filters')

@endsection

@section('content-body')
<div class="inline fields">
    <div style="margin-left: auto; margin-right: 1px;">
        <button type="button" class="ui blue  button add">
        <i class="add icon"></i>
        Upload Photo / Video
        </button>
    </div>
</div>
<div class="ui divider"></div>
<div class="ui medium images">
    <a data-gallery="photoviewer" data-title="Title" data-group="a" href="{{ asset('frontend/asset/img/example/example-1.JPG') }}">
        <img src="{{ asset('frontend/asset/img/example/example-1.JPG') }}" style="height: 120px; object-fit: cover;" alt="">
    </a>
    <a data-gallery="photoviewer" data-title="Title" data-group="a" href="{{ asset('frontend/asset/img/example/example-2.JPG') }}">
        <img src="{{ asset('frontend/asset/img/example/example-2.JPG') }}" style="height: 120px; object-fit: cover;">
    </a>
    <a data-gallery="photoviewer" data-title="Title" data-group="a" href="{{ asset('frontend/asset/img/example/example-1.JPG') }}">
        <img src="{{ asset('frontend/asset/img/example/example-3.JPG') }}" style="height: 120px; object-fit: cover;">
    </a>
    <a data-gallery="photoviewer" data-title="Title" data-group="a" href="{{ asset('frontend/asset/img/example/example-4.JPG') }}">
        <img src="{{ asset('frontend/asset/img/example/example-4.JPG') }}" style="height: 120px; object-fit: cover;" alt="">
    </a>
</div>
@endsection

@section('init-modal')
<script type="text/javascript">
    initModal = function(){
        $('.date').calendar({
            type: 'date',
            
        });
    }
</script>
@endsection
