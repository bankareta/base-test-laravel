<div class="ui fixed blue menu" style="background-color: #000000 !important;">
    <a href="{{ url('/home') }}" class="header item" style="letter-spacing: 0px; color: #fff !important">
        <img class="logo" src="{{ asset('img/asset-new/logo.png') }}">&nbsp;&nbsp;
        {{ config('app.name') }}
    </a>
    <div class="menu">
        <a href="#" class="item" onclick="toggleSidebar()" style="color: #fff !important">
            <i class="sidebar icon"></i>
        </a>
    </div>

    <div class="right menu">
        @if (auth()->user())
            <div class="ui pointing dropdown item " style="color: #fff !important">
                <div class="floating ui red small label" id="count-notif">{{ $notifs }}</div>
                <i class="ui bell icon" style="margin-right: 0;"></i>
                <div class="mfs menu"  style="max-height: 25rem !important;margin-top: 0.14em;">
                    <div style="padding: 0px !important;width:480px;">
                        <div class="ui center attached segment mfs " id="area-notif" style="max-height: 25rem !important;overflow-y: scroll;overflow-x: hidden !important;">

                        </div>
                        <a href="{{ url('jobs/all-notif') }}">
                            <div class="ui bottom attached segment center aligned">
                                See All
                            </div>
                        </a>
                    </div>
                </div>
              </div>
            <div class="ui pointing dropdown item" tabindex="0" style="color: #fff !important">
                <div class="ui horizontal list">
                  <div class="item">
                    <img class="ui avatar image" src="{!! auth()->user()->showfotopath() !!}">
                    <div class="content" style="color: #fff !important">
                      <div class="header" style="color: #fff !important">{!! auth()->user()->display !!}</div>
                      {{ auth()->user()->showroles() }}
                    </div>
                  </div>
                </div>
                <i class="dropdown icon"></i>
                <div class="menu transition hidden" tabindex="-1">
                    <a class="item" href="{{ url('/profile') }}"><i class="user icon"></i> Profile</a>
                    <a class="item" href="{{ url('/logout') }}"><i class="sign out icon"></i> Logout</a>
                </div>
            </div>
        @else
            <div class="ui pointing dropdown item" tabindex="0">
                - <i class="dropdown icon"></i>
                <div class="menu transition hidden" tabindex="-1">
                    <a class="item" href="{{ url('/login') }}"><i class="sign out icon"></i> Login</a>
                </div>
            </div>
        @endif
    </div>
</div>
