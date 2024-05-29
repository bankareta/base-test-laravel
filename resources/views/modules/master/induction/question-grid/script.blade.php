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
                    deletefile();
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
                    },
                    error : function(resp){
                    },
                })
            });
        }

        $('.mfs.multiple-custom.upload.button').on('click', function () {
		    $(this).parents('.small.card').find('.mfs.multiple.file-custom.input').trigger('click');
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
                                    $.each(resp.url, function (index, value) {
                                        elem.parents('.cards').append(`<div class="small card">
                                            <a class="image" href="` + value['url'] + `" target="_blank">
                                                <img src="`+ value['url'] +`" style="height:120px !important;">
                                            </a>
                                            <input type="hidden" class="mfs path hidden input" name="fileurl[]" value="`+ value['value'] +`">
                                            <input type="hidden" class="mfs filename hidden input" name="filesname[]" value="`+ value['filename'] +`">
                                            <div class="ui bottom attached red mfs remove-custom picture button">
                                            <i class="trash icon"></i>
                                            Remove Image
                                            </div>
                                        </div>`);
                                    })
                                    mfsremovecustompicturebutton();
                                    on_button = true;
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
                        // window.onbeforeunload = function(d) {
                        //     return "Dude, are you sure you want to leave? Think of the kittens!";
                        // }
                    },
                    data : formData,
                    success: function(resp){
                        $.each(resp.url, function (index, value) {
                            elem.parents('.cards').append(`<div class="small card">
                                <a class="image" href="` + value['url'] + `" target="_blank">
                                    <img src="`+ value['url'] +`" style="height:120px !important;">
                                </a>
                                <input type="hidden" class="mfs path hidden input" name="fileurl[]" value="`+ value['value'] +`">
                                <input type="hidden" class="mfs filename hidden input" name="filesname[]" value="`+ value['filename'] +`">
                                <div class="ui bottom attached red mfs remove-custom picture button">
                                <i class="trash icon"></i>
                                Remove Image
                                </div>
                            </div>`);
                        })
                        on_button = true;
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

        $(document).on('change', '.pre_ans', function(e){
            if($(this).find(":selected").val()){
                var url = '{{ url($pageUrl) }}/get-pre-quest/'+$(this).find(":selected").val();
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    timeout:15000,
                    success: function(resp){
                        $('.questionpre').val(resp.data['desc']);
                        $('.type_answer').dropdown('refresh');
                        var sttts = resp.data['status'] == 1 ? 1:'0';
                        $('.type_answer').dropdown('set selected',sttts);
                        $('.answer1pre').val(resp.data['answer']['answer_1']);
                        $('.answer2pre').val(resp.data['answer']['answer_2']);
                        $('.answer3pre').val(resp.data['answer']['answer_3']);
                        $('.answer4pre').val(resp.data['answer']['answer_4']);
                        var i;
                        var store = '{{asset("storage")}}/';
                        $('.exist').remove();
                        for (i = 0; i < resp.data['files'].length; ++i) {
                            $('.showimgpre').append(`
                            <div class="small card exist">
                                <a class="image" href="`+store+resp.data['files'][i]['fileurl']+`" target="_blank">
                                    <img src="`+store+resp.data['files'][i]['fileurl']+`" style="height:120px !important;">
                                </a>
                                <input type="hidden" class="mfs path hidden input" name="filespathexist[]" value="`+resp.data['files'][i]['fileurl']+`">
                                <input type="hidden" class="mfs path hidden input" name="filesnameexist[]" value="`+resp.data['files'][i]['filename']+`">
                                <div class="ui bottom attached removefilesex button">
                                    <i class="trash icon"></i>
                                    Remove
                                </div>
                            </div>
                            `);
                        }
                        $('.removefilesex.button').on('click', function () {
                            $(this).parents('.small.card').remove();
                        });

                        $('input[name="true"]').each(function () {
                            if ($(this).val() == resp.data['answer']['result']) 
                            $(this).prop("checked", true)
                        });
                    },
                    error: function(resp){
                        
                    },
                })
            }else{
                
            }
        });

        $('.deny').on('click', function(){
            deletefile();
        });
        
        $('.type_answer').on('change', function(){
            var multi = `
                <tr class="multichoose">
					<td class="one wide">
						<div class="field">
						<div class="ui radio checkbox">
							<input type="radio" name="true" value="1" checked>
							<label>A</label>
						</div>
						</div>
					</td>
					<td>
						<div class="field">
							<textarea name="answer[1]" class="transparent answer1pre"></textarea>
						</div>
					</td>
					<td class="one wide">
						<div class="field">
						<div class="ui radio checkbox">
							<input type="radio" name="true" value="2">
							<label>B</label>
						</div>
						</div>
					</td>
					<td>
						<div class="field">
							<textarea name="answer[2]" class="transparent answer2pre"></textarea>
						</div>
					</td>
				</tr>
                <tr class="multichoose">
                    <td class="one wide">
						<div class="field">
							<div class="ui radio checkbox">
								<input type="radio" name="true" value="3">
								<label>C</label>
							</div>
						</div>
					</td>
					<td>
						<div class="field">
							<textarea name="answer[3]" class="transparent answer3pre"></textarea>
						</div>
					</td>
					<td class="one wide">
						<div class="field">
						<div class="ui radio checkbox">
							<input type="radio" name="true" value="4">
							<label>D</label>
						</div>
						</div>
					</td>
					<td>
						<div class="field">
							<textarea name="answer[4]" class="transparent answer4pre"></textarea>
						</div>
					</td>
                </tr>
            `;
            var truefalse = `
                <tr class="truefalse">
                    <td class="one wide" colspan="2">
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="true" value="1" checked>
                                <label>True</label>
                            </div>
                        </div>
                    </td>
                    <td class="one wide" colspan="2">
                        <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="true" value="2">
                            <label>False</label>
                        </div>
                        </div>
                    </td>
                </tr>
            `;
            stts = $(this).find(":selected").val();
            if(stts){
                if(stts == 0){
                    $('.truefalse').remove();
                    $('.show-answer').append(multi);
                }else{
                    $('.multichoose').remove();
                    $('.show-answer').append(truefalse);
                }
            }else{
                $('.truefalse').remove();
                $('.multichoose').remove();
            }
        });
        
        function deletefile() {
            var urldel = '{{ url('picture/bulk-unlink') }}';
            var csrftoken = '{{ csrf_token() }}';
            var element = $('input[name="fileurl[]"]')
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
    }
  </script>