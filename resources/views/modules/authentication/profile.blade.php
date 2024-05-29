@extends('layouts.form')

@section('css')
@append

@section('js')
@append
@section('scripts')
    <script type="text/javascript">
    $('.special.cards .image').dimmer({
      on: 'hover'
    });

    $('div.change.picture.button').on('click', function (e) {
        var filebutton = $(this).parents('.card').find('input[type="file"]');
        console.log(filebutton);
        filebutton.trigger('click');
    });

    $('input[type="file"]').on('change', function (f) {
        var loading = `<div class="ui active inverted dimmer">
                        <div class="ui small text loader">Loading</div>
                    </div>`;

        var elem = $(this);
        var url = $(this).data('url');

        var formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('id', '{{ auth()->user()->id }}');
        formData.append('picture', f.target.files[0]);

        $.ajax({
            url: url,
            type: "POST",
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend : function () {
                elem.parents('.card').append(loading);
            },
            data : formData,
            success: function(resp){
                console.log(resp);
                elem.parents('.card').find('.ui.active.inverted.dimmer').remove();
                elem.parents('.card').find('img').attr('src', resp.url);
            },
            error : function(resp){
            },
        })
    });
    </script>
@append

@section('content-header')
@endsection

@section('form')
    <form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
        {!! csrf_field() !!}
        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
        <div class="ui grid">
            <div class="sixteen wide column">
                <table class="ui borderless very basic table">
                    <tbody>
                        <tr>
                            <td rowspan="4" class="five wide center aligned top aligned">
                                <div class="ui special cards">
                                    <div class="card">
                                        <input type="file" class="hidden" name="fotopath" accept="image/*" data-url="{{ url($pageUrl.'pic-upload/') }}">
                                        <div class="blurring dimmable image">
                                            <div class="ui dimmer">
                                                <div class="content">
                                                    <div class="center">
                                                        <div class="ui inverted change picture button">Upload</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <img src="{{ auth()->user()->showfotopath() }}">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2" style="padding-left:0px;">
                                <div class="field">
                                    <label>Full name</label>
                                    <input type="text" placeholder="Full Name" name="fullname" value="{{ auth()->user()->fullname }}">
                                </div>
                            </td>
                            <td>
                      <div class="field maxdate">
            						<label>Birthdate</label>
            						<div class="ui icon input" style="width: 100%; height: 35px">
            							<input type="text" name="birthdate" style="height: 35px;" value="{{ Helpers::DateToString(auth()->user()->birthdate) }}">
            							<i class="calendar alternate icon"></i>
            						</div>
            					</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left:0px;">
                                <div class="field">
                                    <label>Gender</label>
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="gender" value="0" {{ auth()->user()->gender != NULL ?( auth()->user()->gender == 0 ? 'checked' : '') : 'checked' }}>
                                                <label>Male</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="gender" value="1" {{ auth()->user()->gender != NULL ?( auth()->user()->gender == 1 ? 'checked' : '') : '' }}>
                                                <label>Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                              <label>Site :</label><br>
                              {!! auth()->user()->siteOn() !!}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-left:0px;">
                                <div class="field">
                                    <label>Address</label>
                                    <textarea name="address">{!! auth()->user()->address !!}</textarea>
                                </div>
                            </td>
                            <td class="five wide top aligned">
                                <div class="field">
                                    <label>Signature</label>
                                    <div class="ui special cards">
                                        <div class="small card">
                                            <input type="file" class="hidden" name="signaturepath" accept="image/png" data-url="{{ url($pageUrl.'sign-upload/') }}">
                                            <div class="blurring dimmable image">
                                                <div class="ui dimmer">
                                                    <div class="content">
                                                        <div class="center">
                                                            <div class="ui inverted change picture button">Upload</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <img src="{{ auth()->user()->showsignaturepath() }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    	<div class="ui two column grid">
    		<div class="left aligned column">
    			<a class="ui labeled icon button" href="{{ url($pageUrl) }}">
    				<i class="chevron left icon"></i>
    				Back
    			</a>
    		</div>
    		<div class="right aligned column">
                <div class="ui positive right labeled icon save as page button">
                    Update
                    <i class="checkmark icon"></i>
                </div>
    		</div>
    	</div>
    </form>
@endsection
