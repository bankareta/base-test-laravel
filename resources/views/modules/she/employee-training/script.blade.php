<script type="text/javascript">
    $('.maxdate').calendar({
      type: 'date',
      initialDate: new Date(),
      maxDate: new Date(),
      text: {
      },
    });

    $('.mindate').calendar({
      type: 'date',
      initialDate: new Date(),
      minDate: new Date(),
      text: {
      },
    });

    $(document).ready(function () {
      $('.centered.cards .dimmable.image').dimmer({
        on: 'hover'
      });
      var csrftoken = '{{ csrf_token() }}'
      var on_button = false;
      $('.save.page.button').on('click', function () {
        on_button = true;
      })

      $(window).on('unload', function() {
        if (!on_button)
        {
          deletefile2();
        }
      });
    });

    function mfsremovecustompicturebutton() {
      $('.mfs.remove-custom.picture.button').on('click', function () {
        var pathinput = $(this).parents('.card').find('.mfs.path.hidden.input').val();
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
            elem.parents('.card').append(loading);
          },
          data : formData,
          success: function(resp){
            elem.parents('.card').remove();
                      $('input[name="picture[]"]').val('');
          },
          error : function(resp){
          },
        })
      });
    }

    function deletefile2() {
      var urldel = '{{ url('picture/bulk-unlink') }}';
      var csrftoken = '{{ csrf_token() }}';
      var element = $('input[name="filespath[]"]')
      var element2 = $('input[name="filespath2[]"]')
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
      if(element2.length > 0)
      {
        var filedelete = [];
        var payload = new FormData();
        payload.append('_token', csrftoken)
        for(i=0; i < element2.length; i++)
        {
          payload.append('filedelete['+i+']', element2[i].value)
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

    $('.mfs.multiple-custom.upload.button').on('click', function () {
      $(this).parents('.small.card').find('.mfs.multiple.file-custom.input').trigger('click');
    });
    
    $('.mfs.multiple.file-custom.input').on('change', function (f) {
        var maxsize = 10933862;
        var elem = $(this);
        var url = $(this).data('url');
        var files = f.target.files;
        var success = [];
        var failed = [];
        var faileditem = '';
        var fileExtension = ['png','jpg','jpeg','pdf'];
        
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
        var loading = `<div class="ui active inverted dimmer">
            <div class="ui small text loader">Uploading... wait for a while..</div>
        </div>`;
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
                                window.onbeforeunload = function(d) {
                                    return "Dude, are you sure you want to leave? Think of the kittens!";
                                }
                            },
                            data : formData,
                            success: function(resp){
                                $.each(resp.url, function (index, value) {
                                    var filename = '';
                                    if(value['filename'])
                                    {
                                        filename = `
                                                    <input type="hidden" class="mfs path hidden input" name="filesname[]" value="`+ value['filename'] +`">
                                                    <div class="content">
                                                    <div class="description">
                                                    `+ value['filename'] +`
                                                    </div>
                                                    </div>`;
                                    }
                                    elem.parents('.cards').append(`<div class="small card">
                                        <a class="image" href="` + value['url'] + `" target="_blank">
                                        <img src="`+ value['url_download'] +`" style="height:120px !important;">
                                        </a>
                                        <input type="hidden" class="mfs path hidden input" name="filespath[]" value="`+ value['value'] +`">
                                        
                                        <div class="ui bottom attached red mfs remove-custom picture button">
                                        <i class="trash icon"></i>
                                        Remove File
                                        </div>
                                        </div>`
                                    );
                                })
                                mfsremovecustompicturebutton();
                                elem.parents('.cards').find('.ui.active.inverted.dimmer').remove();
                                window.onbeforeunload = function(d) {
                                    return "Dude, are you sure you want to leave? Think of the kittens!";
                                }
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
                    window.onbeforeunload = function(d) {
                        return "Dude, are you sure you want to leave? Think of the kittens!";
                    }
                },
                data : formData,
                success: function(resp){
                $.each(resp.url, function (index, value) {
                        var filename = '';
                        if(value['filename'])
                        {
                        filename = `<input type="hidden" class="mfs path hidden input" name="filesname[]" value="`+ value['filename'] +`">`;
                        }
                    elem.parents('.cards').append(`<div class="small card">
                                    <a class="image" href="` + value['url'] + `" target="_blank">
                                    <img src="`+ value['url_download'] +`" style="height:120px !important;">
                                    </a>
                                    <input type="hidden" class="mfs path hidden input" name="filespath[]" value="`+ value['value'] +`">
                                    `+filename+`
                                    <div class="ui bottom attached red mfs remove-custom picture button">
                                    <i class="trash icon"></i>
                                    Remove File
                                    </div>
                                    </div>`
                                );
                    })
                    mfsremovecustompicturebutton();
                    elem.parents('.cards').find('.ui.active.inverted.dimmer').remove();
                    window.onbeforeunload = function(d) {
                        return "Dude, are you sure you want to leave? Think of the kittens!";
                    }
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
    
    $(document).on('click', '.red.mfs.remove.pictureexist.button', function(e){
        var elem = $(this);
        var id = $(this).data('id');
        var hta = `
            <input type="hidden" name="materi_deleted_id[]" placeholder="Title" value="`+id+`">
        `;
        $('#showFileExistDelete').append(hta);
        $('input[name="picture[]"]').val('');
        elem.parents('.card').remove();
    });
</script>