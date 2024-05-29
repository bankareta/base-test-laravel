@extends('layouts.form')


@section('css')
@append

@section('js')
    <script src="{{ asset('plugins/chartjs/Chart.bundle.min.js') }}"></script>
@append

@section('styles')
    <style type="text/css">

    </style>
@append

@section('scripts')
    @include('modules.chart.home')
@append

@section('content')
    <div class="ui grid">
        <div class="four column row">
            <div class="column">
                <div class="ui clearing segment">
                    <h4 class="ui header">
                        <img class="ui image" src="{{ asset('img/icon.png') }}">
                        <div class="content">
                            Learn More
                            <div class="sub header">Check out our plug-in marketplace</div>
                        </div>
                    </h4>
                  <div class="ui right floated mini icon blue button"><i class="chevron right icon"></i></div>
                </div>
            </div>
            <div class="column">
                <div class="ui clearing segment">
                    <h4 class="ui header">
                        <img class="ui image" src="{{ asset('img/icon.png') }}">
                        <div class="content">
                            Learn More
                            <div class="sub header">Check out our plug-in marketplace</div>
                        </div>
                    </h4>
                    <div class="ui right floated mini icon red button"><i class="chevron right icon"></i></div>
                </div>
            </div>
            <div class="column">
                <div class="ui clearing segment">
                    <h4 class="ui header">
                        <img class="ui image" src="{{ asset('img/icon.png') }}">
                        <div class="content">
                            Learn More
                            <div class="sub header">Check out our plug-in marketplace</div>
                        </div>
                    </h4>
                    <div class="ui right floated mini icon blue button"><i class="chevron right icon"></i></div>
                </div>
            </div>
            <div class="column">
                <div class="ui clearing segment">
                    <h4 class="ui header">
                        <img class="ui image" src="{{ asset('img/icon.png') }}">
                        <div class="content">
                            Learn More
                            <div class="sub header">Check out our plug-in marketplace</div>
                        </div>
                    </h4>
                    <div class="ui right floated mini icon red button"><i class="chevron right icon"></i></div>
                </div>
            </div>
        </div>
        <div class="eight wide column">
            <div class="ui clearing segment">
                <h4 class="ui header">
                    <img class="ui image" src="{{ asset('img/icon.png') }}">
                    <div class="content">
                        Learn More
                        <div class="sub header">Check out our plug-in marketplace</div>
                    </div>
                </h4>
              <div class="ui right floated mini icon blue button"><i class="chevron right icon"></i></div>
            </div>
        </div>
        <div class="four wide column">
            <div class="ui clearing segment">
                <h4 class="ui header">
                    <img class="ui image" src="{{ asset('img/icon.png') }}">
                    <div class="content">
                        Learn More
                        <div class="sub header">Check out our plug-in marketplace</div>
                    </div>
                </h4>
              <div class="ui right floated mini icon blue button"><i class="chevron right icon"></i></div>
            </div>
        </div>
        <div class="four wide column">
            <div class="ui clearing segment">
                <h4 class="ui header">
                    <img class="ui image" src="{{ asset('img/icon.png') }}">
                    <div class="content">
                        Learn More
                        <div class="sub header">Check out our plug-in marketplace</div>
                    </div>
                </h4>
              <div class="ui right floated mini icon blue button"><i class="chevron right icon"></i></div>
            </div>
        </div>
    </div>
@endsection
