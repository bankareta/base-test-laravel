@extends('layouts.auth')

@section('content')
<div class="ui middle aligned center aligned grid">
    <div class="column" style="margin-left: 28px;">
        <h2 class="ui red image header">
            <a href="https://www.floweradvisor.com.ph/flowersphilippines" target="_blank" rel="noopener noreferrer">
                <img src="https://aldmic.com/images/flower-advisor-logo.png" class="image" style="width:16em">
            </a>
            {{-- <div class="content">
                <i>{{ config('app.name') }}</i>
            </div> --}}
        </h2>

        @if (count($errors) > 0)
        <div class="ui negative message">
            <i class="close icon"></i>
            <div class="header">
                <strong>Sorry, </strong>There was an error trying to login. please try again<br>
            </div>
            @foreach ($errors->all() as $error)
                <span>{{ $error }}</span>
            @endforeach
        </div>
        @endif
        <form class="ui large form" role="form" method="POST" action="{{ url('/login') }}" autocomplete="off">
            {!! csrf_field() !!}
            <div id="showerrorie">
                <div class="ui negative message">
                    We’ll stop supporting this browser. For the best experience please update your browser to <br><a href="#">Chrome, Mozila Firefox, Microsoft Edge Or Opera</a>.
                </div>
            </div>
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input id="username" type="username" placeholder="Username / Email" class="form-control" name="username" value="{{ old('username') }}" required autofocus
                        oninvalid="this.setCustomValidity('Please Enter Your Username or Email')" oninput="setCustomValidity('')">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input id="password" type="password" class="form-control" placeholder="Password" name="password" required oninvalid="this.setCustomValidity('Please Enter Your Password')" oninput="setCustomValidity('')">
                    </div>
                </div>
                <div class="field">
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
                <div class="field">
                    <button type="submit" class="ui fluid large red submit button">Login</button>
                </div>
                <div class="ui horizontal divider">
                    Or
                </div>
                <div class="field">
                    <a href="{{ route('register') }}"><button type="button" class="ui fluid large blue button">Register</button></a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
