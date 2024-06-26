@extends('layouts.register')

@section('style')
<style>
    .content {
        max-width: 960px;
    }
    .ui.dropdown, .ui.calendar, .ui.selection.multiple {
        width: 100%
    }
    .ui.file.input input[type="file"] {
        display: none;
    }
</style>
@append
@section('content')
<div class="ui middle aligned center aligned grid">
    <div class="eight wide column content">
        <form class="ui form" id="dataForm" method="POST" action="{{ url('/register') }}">
            {!! csrf_field() !!}
            <div class="ui top attached segment">
                <div class="ui grid">
                    <div class="sixteen wide column">
                        <div class="ui header">
                            <a href="https://www.floweradvisor.com.ph/flowersphilippines" target="_blank" rel="noopener noreferrer">
                                <img src="https://aldmic.com/images/flower-advisor-logo.png" class="image" style="padding: 80px 0px 0px 0px;width:16em;">
                            </a>
                            {{-- <div class="content">
                                <i>{{ config('app.name') }}</i>
                            </div> --}}
                        </div>
                        <div class="ui divider"></div>
                        {{-- @if (count($errors) > 0) --}}
                        <div class="ui negative message" style="display: none;">
                            {{-- <i class="close icon"></i> --}}
                            <div class="header">
                                <strong>Mohon Maaf, </strong>Terjadi Kesalahan<br>
                            </div>
                            <ul class="ui left aligned" style="text-align: left;">
                                {{-- @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach --}}
                            </ul>
                        </div>
                        {{-- @endif --}}
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">Fullname</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="ui left icon input">
                                    <i class="user icon"></i>
                                    <input type="text"  placeholder="Fullname" name="fullname" value="{{ old('fullname') }}">
                                </div>
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">Username</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="ui left icon input">
                                    <i class="user icon"></i>
                                    <input type="text"  placeholder="Username" name="username" value="{{ old('username') }}">
                                </div>
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="email" style="text-align: left;">Email</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="ui left icon input">
                                    <i class="mail icon"></i>
                                    <input type="text"  placeholder="E-mail" name="email" value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">Password</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="ui left icon input">
                                    <i class="lock icon"></i>
                                    <input type="password" name="password" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">Confirm Password</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="ui left icon input">
                                    <i class="unlock alternate icon"></i>
                                    <input type="password" name="password_confirmation" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div>
                                <img src="{!! captcha_src('flat') !!}" alt="captcha" id="captcha-image">
                                <br>
                                <button type="button" id="reload-captcha">Reload</button>
                            </div>
                            <input type="text" id="captcha" name="captcha" placeholder="Captcha">
                        </div>
                    </div>
                </div>
            </div>

            <div class="ui bottom attached segment">
                <button type="button" class="ui fluid large blue entry button" >Register</button>
                <div class="ui divider"></div>
                <div class="center aligned" style="text-align: center">
                    <span>Sudah Memiliki Akun? <a href="{{ url('/login') }}">Login</a></span>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
     // disable enter submit form
    // $(document).on('keyup keypress', 'input', function(e) {
    //   if(e.which == 13) {
    //     console.log('tada..')
    //     console.log(e.which)
    //     // e.preventDefault();
    //     return false;
    //   }
    // });

    $('#terms').on('change', function(){
        if(this.checked){
            $('.blue.entry.button').removeAttr('disabled');
        }else{
            $('.blue.entry.button').attr('disabled','disabled');
        }
    });

    $('select[name=district]').on('change', function(){
        $.ajax({
            url: '{{ url('ajax/option/city') }}',
            type: 'POST',
            data: {
                province: this.value
            },
        })
        .done(function(response) {
            $('select[name=city]').html(response)
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    })

    $(document).on('input', 'input[name="identity_number"]', function(e){
        var x = `<div class="ui basic red pointing prompt label transition visible">Length must be at least 16 character</div>`;
        var d = `<div class="ui basic red pointing prompt label transition visible"> Must be a number</div>`;
        if ($.isNumeric(this.value))
        {
            if (this.value.length != 11) {

                $('#tampil-alert-identity_number').html(x);

            }else{
                $('#tampil-alert-identity_number').html('');
            }
        }else{
            $('#tampil-alert-identity_number').html(d);
        }
    })

    $(document).on('click', '.ui.file.input input:text, .ui.button', function (e) {
        $(e.target).parent().find('input:file').click();
    });

    $(document).on('change', '.ui.file.input input:file', function (e) {
        var file = $(e.target);
        var name = '';

        for (var i = 0; i < e.target.files.length; i++) {
            name += e.target.files[i].name + ', ';
        }
        // remove trailing ","
        name = name.replace(/,\s*$/, '');
        console.log(name);

        $('input:text', file.parent()).val(name);
    });

    $('.table.fasilitas').on('click', '.modal-delete', function(event) {
        event.preventDefault();
        table = $(this).closest('tr')
        table.remove()
    })

    $('.blue.entry.button').on('click',function(event) {
        swal({
            title: 'Save Data?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Save',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result) {
                $('.ui.negative.message').find('ul').html('')
                $("#dataForm").ajaxSubmit({
                    success: function(resp){
                        console.log(resp);
                        location.href = '{{ url('/login') }}'
                    },
                    error: function(resp){
                        $('.ui.negative.message').css('display', '')
                        $.each(resp.responseJSON.errors, function(index, val) {
                            $('.ui.negative.message').find('ul').append('<li>'+val[0]+'</li>');
                        });
                    }
                });
            }
        })
    });
</script>
@append
