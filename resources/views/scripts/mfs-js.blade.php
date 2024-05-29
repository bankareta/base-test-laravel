<script type="text/javascript">
$(document).ready(function () {
    var uploadurl = '{{ url($pageUrl.'upload') }}';
    var deleteurl = '{{ url($pageUrl.'removefile') }}';
    var csrftoken = '{{ csrf_token() }}'
    msingelefileuploads(uploadurl, deleteurl, csrftoken);
  	var on_button = false;
  	$('.save.page.button').on('click', function () {
  		on_button = true;
  	})
  	$(window).on('unload', function() {
  		if (!on_button)
  		{
  			deletefile();
  		}
  	});
});

function deletefile() {
	var urldel = '{{ url($pageUrl.'removeallfile') }}';
	var csrftoken = '{{ csrf_token() }}';
	var element = $('input[name="fileurl"]')
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
        xhr.error = function (e) {
            window.onbeforeunload = false;
            swal(
                'Error !',
                'Connection has been terminated, contact the administrator.',
                'error'
                ).then(function(e){
                    location.reload();
                });
        }
        xhr.onreadystatechange = function() {
            if(xhr.readyState == XMLHttpRequest.DONE)
            {
                console.log(filedelete);
            }
        }
    }
}

function msingelefileuploads(url,deleteurl,csrftoken) {
    var element = $('.mfs.fileupload');
    var button = element.find('.upload.file.button');
    var fileinput = element.find('input[type="file"].mfs.file.upload');
    var filename = element.find('label[class="show filename"]');
    var progress = element.find('.ui.standard.progress');
    var savebutton = $('.ui.positive.right.labeled.icon.save.as.page.button');
    button.on('click', function (e) {
        e.preventDefault();
        // fileinput.trigger('click');  //[Comment] because bug
    })

    fileinput.on('change', function (f) {
        filename.attr('style', 'color:black;');
        filename.html(f.target.files[0].name);
        var maxsize = {{Helpers::convertfilesize()}};
        if(f.target.files[0].size <= maxsize)
        {
            element.find('.remove.file.button').parents('.two.wide.field').remove();
            var payload = new FormData();
            payload.append('_token', csrftoken)
            payload.append('file', f.target.files[0])

            var xhr = new XMLHttpRequest();
            xhr.open('POST', url, true);

            xhr.upload.onprogress = function (e) {
                button.addClass('loading disabled');
                savebutton.addClass('loading disabled');
                if (e.lengthComputable) {
                    progress.progress({
                        total : e.total,
                        value : e.loaded,
                    })
                }
            }
            xhr.upload.onloadstart = function (e) {
                progress.progress({
                    total : e.total,
                    value : 0,
                })
                window.onbeforeunload = function(d) {
                    return "Dude, are you sure you want to leave? Think of the kittens!";
                }
            }
            xhr.upload.onloadend = function (e) {
                button.addClass('loading disabled');
                progress.progress({
                    value : e.loaded,
                })
            }

            xhr.send(payload);

            xhr.onreadystatechange = function() {
                if(xhr.readyState == XMLHttpRequest.DONE)
                {
                    var response = JSON.parse(xhr.responseText);
                    if(!response['status'])
                    {
                        progress.progress('set error');
                        progress.progress('set bar label', 'Upload Failed');
                    }else{
                        if(response['url'] && response['filename'])
                        {
                            setTimeout(function(){
                                fileinput.attr('disabled',true);
                                progress.progress('set success');
                                progress.progress('set bar label', 'Upload Success');
                                element.find('.fields').append(`<div class="one wide field">
                                    <label class="show filename">&nbsp;&nbsp;</label>
                                    <a class="ui fluid small red icon remove file mfs button"><i class="trash icon"></i></a>
                                    <input type="hidden" value="`+response['url']+`" name="fileurl">
                                    <input type="hidden" value="`+response['filename']+`" name="filename">
                                </div>`)
                                mdeleteuploads(deleteurl, csrftoken, element);
                            }, 500)
                        }else{
                            progress.progress('set error');
                            progress.progress('set bar label', 'Upload Failed');
                        }
                    }
                    button.removeClass('loading');
                    savebutton.removeClass('loading disabled');
                }else {
                    progress.progress('set error');
                    progress.progress('set bar label', 'Upload Failed');
                    button.removeClass('loading disabled');
                    savebutton.removeClass('loading disabled');
                }
            }
        }else{
            filename.attr('style', 'color:red;');
            filename.html('<i>' + f.target.files[0].name + ' [warning : (size overload), resolve: (upload file size under {!! ini_get("upload_max_filesize") !!}B)] </i>');
        }
    })
}

function mremoveallfiles(url, csrftoken) {
    var element = $('input[name="fileurl"]')
    if(element.length > 0)
    {
        var filedelete = [];

        $.each(element, function (index, elem) {
            filedelete[index] = elem.value;
        })

        var payload = new FormData();
        payload.append('_token', csrftoken)
        payload.append('filedelete[]', filedelete)

        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, false);
        xhr.send(payload);
        xhr.onreadystatechange = function() {
            if(xhr.readyState == XMLHttpRequest.DONE)
            {
            }
        }
    }
}

function mdeleteuploads(url, csrftoken, element) {
    var btn = element.find('.upload.file.button');
    var button = element.find('.remove.file.mfs.button');
    var progress = element.find('.ui.standard.progress');
    var fileurl = element.find('input[name="fileurl"]').val();
    var filename = element.find('label[class="show filename"]');
    var fileinput = element.find('input[type="file"]');

    button.on('click', function (e) {
        e.preventDefault();

        var payload = new FormData();
        payload.append('_token', csrftoken)
        payload.append('fileurl', fileurl)

        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.send(payload);
        xhr.onreadystatechange = function() {
            if(xhr.readyState == XMLHttpRequest.DONE)
            {
                fileinput.attr('disabled',false);
                button.parents('.field:first').remove();
                progress.progress('reset');
                fileinput.val('');
                filename.html('&nbsp;&nbsp;');
                btn.removeClass('disabled');
            }
        }

    })

}

function mfileuploads(url) {
    var element = $('.mfs.fileupload');
    var button = element.find('button');
    var fileinput = element.find('input[type="file"]');
    var filename = element.find('label[class="show filename"]');
    button.on('click', function (e) {
        e.preventDefault();
        fileinput.trigger('click');
    })

    fileinput.on('change', function (f) {
        var stringname = '';
        $.each(f.target.files[0], function (index, val) {
            stringname += val['name'] + ';';
        })
        filename.html(stringname);
    })
}

</script>
