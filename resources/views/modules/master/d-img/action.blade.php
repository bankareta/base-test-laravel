<script>
    initModal = function(){
        $(document).ready(function () {
            $('.centered.cards .dimmable.image').dimmer({
                on: 'hover'
            });
            var csrftoken = '{{ csrf_token() }}'
            var on_button = false;
            
            
            $(window).on('unload', function() {
                if (!on_button)
                {
                    deletefile2()
                }
            });
            var slider = $('.slider').glide({
                autoplay: false,
                arrowsWrapperClass: 'slider-arrows',
                arrowRightText: '',
                arrowLeftText: ''
            });
        });
        $('.mfs.multiple-custom.upload.button').on('click', function () {
		    $(this).parents('.small.card').find('.mfs.multiple.file-custom.input').trigger('click');
	    });

        $('#position').on('change', function () {
		    val = $(this).val();
            $('.image-preview').css("margin-top",'-'+val+'px');
	    });

        $('#position').on('input', function () {
		    val = $(this).val();
            $('.image-preview').css("margin-top",'-'+val+'px');
	    });

        $('.mfs.multiple.file-custom.input').on('change', function (f) {
            var loading = `<div class="ui active inverted dimmer">
                <div class="ui small text loader">Uploading... wait for a while..</div>
            </div>`;
            var elem = $(this);
            var url = $(this).data('url');
            var files = f.target.files;
            var maxsize = {{Helpers::convertfilesize()}};
            var success = [];
            var failed = [];
            var faileditem = '';

            var formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            for(i = 0; i < files.length; i++)
            {
                if(files[i].size > maxsize)
                {
                    failed.push(files[i].name);
                }else{
                    formData.append('picture['+i+']', files[i]);
                    success.push(files[i].name);
                }
            }
            if(failed.length > 0)
            {
                for(i = 0; i < failed.length; i++)
                {
                    faileditem += failed[i];
                }
                if(failed.length > 0)
                {
                    if(success.length > 0)
                    {
                        swal({
                            title: 'Warning',
                            html: "There is " + failed.length + " (" + faileditem + ")" + " file(s) is above " + "{{ini_get('upload_max_filesize')}}" + "B, the file(s) will not be uploaded",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Upload rest of file',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'Cancel Upload',
                            reverseButtons: true,
                        }).then((result) => {
                            $.ajax({
                                url: url,
                                type: "POST",
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                timeout:15000,
                                
                                beforeSend : function () {
                                    elem.parents('.card').append(loading);
                                },
                                data : formData,
                                success: function(resp){
                                $('#position').attr("readonly", false);
                                $('#img1').css('display','none');
                                $('.ui.visible.message').css('display','none');
                                $('#inputImg').css('display','none');
                                    $.each(resp.url, function (index, value) {
                                        $('#showImg').append(`
                                        <div class="showing">
                                            <div class="ui top attached label">Preview</div>
                                            <div class="ui center aligned segment" style="padding:0; overflow:hidden; height:356px;width: 1043px;">
                                                <div class="ui bottom attached red mfs remove-custom picture button">
                                                    <i class="trash icon"></i>
                                                Remove Image
                                                </div>
                                                <a class="image" href="` + value['url'] + `" target="_blank">
                                                    <img class="image-preview center aligned" id="showAttachment" style="width: 100%;height: auto;" src="`+ value['url'] +`">
                                                </a>
                                                <input type="hidden" class="mfs path hidden input" name="filespath[]" value="`+ value['value'] +`">
                                                <input type="hidden" class="mfs filename hidden input" name="filesname[]" value="`+ value['filename'] +`">
                                            </div>
                                        </div>
                                        `);
                                    })
                                    mfsremovecustompicturebutton();
                                    var isDragging = false;
                                    elem.parents('.cards').find('.ui.active.inverted.dimmer').remove();
                                    // window.onbeforeunload = function(d) {
                                    //     return "Dude, are you sure you want to leave? Think of the kittens!";
                                    // }
                                },
                                error: function(resp){
                                    var response = resp.responseJSON;
                                    if(typeof response === 'undefined'){
                                        var messagefILE = 'Sorry your file is to large maximum uploaded {{ini_get('upload_max_filesize')}}B';
                                        swal(
                                        'Warning!',
                                        ''+messagefILE,
                                        'error'
                                        );
                                        elem.parents('.cards').find('.ui.active.inverted.dimmer').remove();
                                    }
                                },
                            })
                        }, (dismiss) => {
                            swal(
                            'Warning!',
                            'Upload Canceled',
                            'error'
                            );
                        })
                    }else{
                        swal(
                        'Warning!',
                        'File(s) is above {{ini_get('upload_max_filesize')}}B',
                        'error'
                        );
                    }
                }
            }else {
                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    timeout:15000,
                    beforeSend : function () {
                        elem.parents('.card').append(loading);
                    },
                    data : formData,
                    success: function(resp){
                        $('#position').attr("readonly", false);
                        $('#img1').css('display','none');
                        $('.ui.visible.message').css('display','none');
                        $('#inputImg').css('display','none');
                        $.each(resp.url, function (index, value) {
                            $('#showImg').append(`
						    <div class="showing">
                                <div class="ui top attached label">Preview</div>
                                <div class="ui center aligned segment" style="padding:0; overflow:hidden; height:356px;width: 1043px;">
                                    <div class="ui bottom attached red mfs remove-custom picture button">
                                        <i class="trash icon"></i>
                                    Remove Image
                                    </div>
                                    <a class="image" href="` + value['url'] + `" target="_blank">
                                        <img class="image-preview center aligned" id="showAttachment" style="width: 100%;height: auto;" src="`+ value['url'] +`">
                                    </a>
                                    <input type="hidden" class="mfs path hidden input" name="filespath[]" value="`+ value['value'] +`">
                                    <input type="hidden" class="mfs filename hidden input" name="filesname[]" value="`+ value['filename'] +`">
                                </div>
						    </div>
                            `);
                        })
                        mfsremovecustompicturebutton();
                        elem.parents('.cards').find('.ui.active.inverted.dimmer').remove();
                    },
                    error: function(resp){
                        var response = resp.responseJSON;
                        if(typeof response === 'undefined'){
                            var messagefILE = 'Sorry your file is to large maximum uploaded {{ini_get('upload_max_filesize')}}B';
                            
                            swal(
                            'Warning!',
                            ''+messagefILE,
                            'error'
                            );
                            elem.parents('.cards').find('.ui.active.inverted.dimmer').remove();
                        }
                    },
                })
            }
        });
        
        function mfsremovecustompicturebutton() {
            $('.mfs.remove-custom.picture.button').on('click', function () {
                var pathinput = $(this).parents().find('.mfs.path.hidden.input').val();
                var elem = $(this);
                var loading = `<div class="ui active inverted dimmer">
                                <div class="ui small text loader">Uploading... wait for a while..</div>
                            </div>`;

                var formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('path', pathinput);

                $.ajax({
                    url: '{{ url('picture/unlink') }}',
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend : function () {
                        elem.parents().parents('.showing').append(loading);
                    },
                    data : formData,
                    success: function(resp){
                        $('#position').val('');
                        $('#position').attr("readonly", true);
                        $('#inputImg').css('display','');
                        $('#img1').css('display','');
                        $('.mfs.multiple.file-custom.input').val("");
                        $('.ui.visible.message').css('display','');
                        elem.parents().parents('.showing').remove();
                    },
                    error : function(resp){
                    },
                })
            });
	    }

        $('.deny').on('click', function(){
            deletefile2();
        });

        function deletefile2() {
            var urldel = '{{ url('picture/bulk-unlink') }}';
            var csrftoken = '{{ csrf_token() }}';
            var element = $('input[name="filespath[]"]')
            if(element.length > 0)
            {
                var filedelete = [];
                var payload = new FormData();
                payload.append('_token', csrftoken)
                for(i=0; i < element.length; i++)
                {
                    payload.append('filedelete['+i+']', element[i].value)
                }

                var xhr = new XMLHttpRequest();
                xhr.open('POST', urldel, false);
                xhr.send(payload);
                xhr.onreadystatechange = function() {
                    if(xhr.readyState == XMLHttpRequest.DONE)
                    {
                        console.log(filedelete);
                    }
                }
            }
        }
        $(document).on('click', '.red.mfs.remove-custom-exist.picture.button', function(e){
            var elem = $(this);
            $('#inputImg').css('display','');
            $('#img1').css('display','');
            $('.mfs.multiple.file-custom.input').val("");
            $('.ui.visible.message').css('display','');
            elem.parents().parents('.showing').remove();
        });
    }
  </script>