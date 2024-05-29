<script type="text/javascript">
	$(document).ready(function () {
		$('.menu .item').tab();
    	$('.next').tab();
    	$(document).on('click','.next',function(){
    		var data = $(this).data('tab');
    		var dataPrev = $(this).data('prev');
    		$('.menu').find("[data-tab='" + dataPrev + "']").removeClass('active');
    		$('.menu').find("[data-tab='" + data + "']").addClass('active');
    	});

	    var csrftoken = '{{ csrf_token() }}'
		var on_button = false;
		$('.save.page.button').on('click', function () {
			on_button = true;
		})
		$('.save.as.published.button').on('click', function () {
			on_button = true;
		})
		$('.save.as.draft.button').on('click', function () {
			on_button = true;
		})
		$('input[type="text"][name="fileupload"]').on('click', function () {
			$(this).parents('.ui.action').find('button.browse.file').trigger('click');
		});
		$(window).on('unload', function() {
			if (!on_button)
			{
				deletefile();
			}
		});
		$('form').attr('autocomplete','off');
		mfsremovepicturebutton();
		removebrowse();
	});

	function deletefile() {
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

	$('.mfs.multiple.upload.button').on('click', function () {
		$(this).parents('.small.card').find('.mfs.multiple.file.input').trigger('click');
	});

    $('.browse.file').on('click', function (e) {
        e.preventDefault();
        var fileinput = $(this).parents('.ui.action.input').find('input[type="file"]');
        browseFile(fileinput);
    });

	$('.file.no-auth').on('click', function (e) {
        e.preventDefault();
		$(this).parents('.ui.action.input').find('.up1');
    });

	$('.file.no-auth2').on('click', function (e) {
        e.preventDefault();
		$(this).parents('.ui.action.input').find('.up2');
    });

	$('.up1').on('change', function (e) {
		if($(this)[0].files.length == 1){
			var sh = $(this).val();
		}else{
			var sh = $(this)[0].files.length+' Files Selected';
		}
		$('.ut1').val(sh);
    });

	$('.up2').on('change', function (e) {
		if($(this)[0].files.length == 1){
			var sh = $(this).val();
		}else{
			var sh = $(this)[0].files.length+' Files Selected';
		}
		$('.ut2').val(sh);
    });

	    $('.removefailedupload').on('click', function (e) {
	        e.preventDefault();
			$(this).parents('.two.fields:first').remove();
	    });

	function browseFile(fileinput) {
	    $(fileinput).unbind('change');
	    $(fileinput).on('change', function (e) {
			var pass = 0;
			var maxsize = {{Helpers::convertfilesize()}};

	        if(e.target.files.length > 0)
	        {
          $.each(e.target.files, function (index, file) {
					var showclass = "success";

					if(file.size > maxsize)
					{
						showclass="error";
						pass = 1;
						$('.showbrowse.file').append(`<div class="two fields bedebahs-file">
							<div class="sixteen wide field">
							<div class="ui progress `+showclass+`">
							<div class="bar">
							<div class="progress"></div>
							</div>
							<div class="label">`+ file.name +` ( Failed to upload size above ` + '{{ini_get('upload_max_filesize')}}' + `B )</div>
							</div>
							</div>
							<div class="two wide field">
							<input type="file" style="display:none !important;" accept="image/*, video/mp4, application/pdf, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/msword, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.ms-excel, application/vnd.ms-powerpoint">
							<div class="two wide field">
								<a href="javascript:void(0)" class="ui icon red removefailedupload button">
								<i class="trash icon"></i>
								</a>
							</div>
							</div>`)

							$('.removefailedupload').on('click', function (e) {
					        e.preventDefault();
									$(this).parents('.two.fields:first').remove();
					    });
					}else{
						var formData = new FormData();
						formData.append('_token', '{{ csrf_token() }}');
						formData.append('file', file);

						var elem = document.createElement('div');
						$(elem).attr('class', 'two fields bedebahs-file');

						$.ajax({
							url: '{{ url('picture/file-upload')  }}',
							type: "POST",
							dataType: 'json',
							processData: false,
							contentType: false,
							data : formData,
							beforeSend : function () {
								$(elem).html(`<div class="fourteen wide field">
									<div class="ui progress `+showclass+`">
										<div class="bar">
											<div class="progress"></div>
										</div>
										<div class="label">`+ file.name +`</div>
									</div>
								</div>
								<div class="two wide field">
									<button class="ui icon red removebrowse button">
									<i class="trash icon"></i>
									</button>
								</div>`);
								$('.showbrowse.file').append(elem)
								$(elem).find('.ui.progress').progress({
				                    total : e.total,
				                    value : 0,
				                })
							},
							uploadProgress : function (event, position, total, percentComplete) {
								$(elem).find('.ui.progress').progress({
									total : total,
									value : percentComplete,
								})
							},
							success: function(resp){
								$(elem).find('.two.wide.field').append(`<input name="filespath[]" value="`+resp.filepath+`" type="hidden">
									<input name="fileurl[]" value="`+resp.filepath+`" type="hidden">
									<input name="filename[]" value="`+resp.filename+`" type="hidden">
								`);
								$(elem).find('.ui.progress').progress({
									total : 100,
									value : 100,
								})
								removebrowse();
					            window.onbeforeunload = function(d) {
					                return "Dude, are you sure you want to leave? Think of the kittens!";
					            }
					            $('.kedosolan').val(('asdaasd',$('.two.fields.bedebahs-file').length));
							},
							error : function(resp){
							},
						})
					}
				});
	        }
	    });
	}

	function removebrowse() {
		$('.removebrowse.button').on('click', function (e) {
			e.preventDefault();
			var pathinput = $(this).parents('.two.wide.field').find('input[name="filespath[]"]').val();
			var elem = $(this);
			var url = '{{ url('picture/unlink') }}';
			if($(this).data('url'))
			{
					url = $(this).data('url');
			}
			var formData = new FormData();
			formData.append('_token', '{{ csrf_token() }}');
			formData.append('path', pathinput);

			$.ajax({
				url: url,
				type: "POST",
				dataType: 'json',
				processData: false,
				contentType: false,
				data : formData,
				success: function(resp){
					elem.parents('div[class="two fields bedebahs-file"]').remove();
					$('.kedosolan').val(('asdaasd',$('.two.fields.bedebahs-file').length));

				},
				error : function(resp){
				},
			})
		});
	}

	$('.mfs.multiple.file.input').on('change', function (f) {
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
               window.onbeforeunload = function(d) {
                  return "Dude, are you sure you want to leave? Think of the kittens!";
               }
              },
              data : formData,
              success: function(resp){
                $.each(resp.url, function (index, value) {
					if(value['param']){
						elem.parents('.cards').append(`<div class="small card">
							<a class="image" href="` + value['url'] + `" target="_blank">
							<img src="`+ value['url_download'] +`" style="height:120px !important;">
							</a>
							<input type="hidden" class="mfs path hidden input" name="filespath[]" value="`+ value['value'] +`">
							<div class="ui bottom attached red mfs remove picture button">
							<i class="trash icon"></i>
							Remove File
							</div>
							</div>`);
					}else{
						elem.parents('.cards').append(`<div class="small card">
							<a class="image" href="` + value['url'] + `" target="_blank">
							<img src="`+ value['url'] +`" style="height:120px !important;">
							</a>
							<input type="hidden" class="mfs path hidden input" name="filespath[]" value="`+ value['value'] +`">
							<div class="ui bottom attached red mfs remove picture button">
							<i class="trash icon"></i>
							Remove File
							</div>
							</div>`);
					}
                })
                mfsremovepicturebutton();
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
						 	filename = `
													<input type="hidden" class="mfs path hidden input" name="filesname[]" value="`+ value['filename'] +`">
													<div class="content">
										        <div class="description">
														`+ value['filename'] +`
										        </div>
										      </div>`;
					 }
			if(value['param']){
				elem.parents('.cards').append(`<div class="small card">
					<a class="image" href="` + value['url'] + `" target="_blank">
					<img src="`+ value['url_download'] +`" style="height:120px !important;">
					</a>
					<input type="hidden" class="mfs path hidden input" name="filespath[]" value="`+ value['value'] +`">
					` + filename + `
					<div class="ui bottom attached red mfs remove picture button">
					<i class="trash icon"></i>
					Remove File
					</div>
					</div>`);
			}else{
				elem.parents('.cards').append(`<div class="small card">
					<a class="image" href="` + value['url'] + `" target="_blank">
					<img src="`+ value['url'] +`" style="height:120px !important;">
					</a>
					<input type="hidden" class="mfs path hidden input" name="filespath[]" value="`+ value['value'] +`">
					` + filename + `
					<div class="ui bottom attached red mfs remove picture button">
					<i class="trash icon"></i>
					Remove File
					</div>
					</div>`);
			}
         })
         mfsremovepicturebutton();
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

	function mfsremovepicturebutton() {
		$('.mfs.remove.picture.button').on('click', function () {
			console.log('asd')
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

	function goBack() {
		window.history.back();
	}
	$(document).ready(function() {
		// $(window).keydown(function(event){
		// 	if(event.keyCode == 13) {
		// 	event.preventDefault();
		// 	return false;
		// 	}
		// });
		$('.ui.search.dropdown').dropdown({
				fullTextSearch: 'exact',
				onChange: function(value) {
						var target = $(this).dropdown();
						if (value!="") {
								target
								.find('.dropdown.icon')
								.removeClass('dropdown')
								.addClass('delete')
								.on('click', function() {
										target.dropdown('clear');
										$(this).removeClass('delete').addClass('dropdown');
										return false;
								});
						}
				}
		});
		$('.chooseDate').calendar({
			type: 'date',
			initialDate: new Date(),
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
		$('.maxdate').calendar({
			type: 'date',
			initialDate: new Date(),
			maxDate: new Date(),
			text: {
			},
		});
		$('.datetime').calendar({
			type: 'datetime',
			initialDate: new Date(),
			text: {
			},
		});
		$('.startdate').calendar({
			type: 'date',
			endCalendar: $('.enddate'),
			text: {
			},
		});
		$('.enddate').calendar({
			type: 'date',
			startCalendar: $('.startdate'),
			text: {
			},
		});
		$('.time').calendar({
			type: 'time',
		});

		$('.startTime').calendar({
			type: 'time',
			endCalendar: $('.endTime'),
			text: {
			},
		});
		$('.endTime').calendar({
			type: 'time',
			startCalendar: $('.startTime'),
			text: {
			},
		});

		$('.year').calendar({
			type: 'year',
		});

		$('.month').calendar({
			type: 'month',
		});

		$('.monthRangeDate').calendar({
			type: 'month',
			onChange: function (date, text) {
				$('.startdate').calendar("set date",date);
				$('.enddate').calendar("set date",new Date(date.getFullYear(), date.getMonth() + 1, 0));
				$('.startdate').calendar({
					type: 'date',
					endCalendar: $('.enddate'),
					text: {
					},
				});
				$('.enddate').calendar({
					type: 'date',
					startCalendar: $('.startdate'),
					text: {
					},
				});
			},
		});
	});
	$('.ui.icon.reset.button').on('click', function(e) {
		$('.ui.search.dropdown').dropdown('clear');
			$('.dropdown .delete').trigger('click');
			setTimeout(function(){
				dt.draw();
			}, 100);
	});

	function approveStatus(data){

		swal({
			title: 'Are You Sure ',
			text: "Close This Action Now ?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes',
			cancelButtonText: 'No'
		}).then((result) => {
			if (result) {
				$.ajax({
					url: data.url,
				    type: 'POST',
				    data: data,
					success: function(resp){
						swal(
							'Successfully!',
							'Status Has Been Closed.',
							'success'
							).then(function(e){
					location.href = '{{ url($pageUrl) }}';

							});
						},
						error : function(resp){
							swal(
								'Failed!',
								'A system error has occurred.',
								'error'
								).then(function(e){
					location.href = '{{ url($pageUrl) }}';

						});
							}
						});

			}
		})
	}

	function saveData(formid) {
		// show loading
		$('#' + formid).find('.loading.dimmer').addClass('active');
		$('#cover').css('display','');
		$(window).unload();
		// begin submit
		$("#" + formid).ajaxSubmit({
			beforeSubmit: function (form, options) {
				// console.log('saass',form,options);
				for(i = 0; i < form.length; i++)
				{
					if(form[i]['name'] == '_token')
					{
						form[i]['value'] = '{{ csrf_token() }}';
					}
				}
			},
			success: function(resp){
				$('#cover').css('display','none');
				window.onbeforeunload = null;

				if(resp.custom_mess){
					var text = resp.custom_mess;
					var title = 'Success!';
				}else{
					var text = 'Data successfully saved.';
					var title = 'Saved!';
				}
				var url = '{{ url($pageUrl) }}';
				if(resp.message)
				{
					text = resp.message;
				}
				if(resp.url)
				{
					url = resp.url;
				}
				if(resp.urlInduction){
					url = '{{ url($pageUrl) }}/'+resp.urlInduction;
				}
				swal({
					title:title,
					text:text,
					type:'success',
					allowOutsideClick: false,
					showCancelButton: false,

					confirmButtonColor: '#0052DC',
					confirmButtonText: 'Close',

					cancelButtonColor: '#6E6E6E',
					cancelButtonText: 'Print'
				}).then((result) => { // ok
					location.href = url;

				}, function(dismiss) { // cancel
					// if (dismiss === 'cancel') { // you might also handle 'close' or 'timer' if you used those
					// 	getNewTab('{{ url('print') }}/' + resp.registration);

					// 	@if(isset($action) && $action == 'create')
					// 		location.href = '{{ url($action.'/'.$jalur) }}';
					// 	@else
					// 		location.href = '{{ url('/') }}';
					// 	@endif
					// } else {
					// 	throw dismiss;
					// }
				})
			},
			error: function(resp){
				$('#cover').css('display','none');
				$('#' + formid).find('.loading.dimmer').removeClass('active');
				// $('#cover').hide();
				var response = resp.responseJSON;
				if(response.error == 'message')
				{
						if(response.tab)
						{
								$('a[data-tab="'+response.tab+'"]').trigger('click');
								$('.ui.bottom.attached.tab.segment[data-tab="'+response.tab+'"]').prepend(`
									<div class="ui negative message">
										<i class="close icon"></i>
										<div class="header">
											We're sorry we can't save the record
										</div>
										<p>`+ response.message +`</p></div>
								`)
						}else{
						$('#' + formid).find('.ui.segment:first').prepend(`
							<div class="ui negative message">
								<i class="close icon"></i>
								<div class="header">
									We're sorry we can't save the record
								</div>
								<p>`+ response.message +`</p></div>
						`)
						}
				}
				$.each(response.errors, function(index, val) {
					clearFormError(index,val);
					showFormError(index,val);
				});
				time = 5;
				interval = setInterval(function(){
					time--;
					if(time == 0){
						clearInterval(interval);
						$('.pointing.prompt.label.transition.visible').fadeOut('slideUp', function(e) {
							$(this).remove();
						});
						$('#' + formid).find('.ui.segment:first').find('.ui.negative.message').remove();
						$('.error').each(function (index, val) {
							$(val).removeClass('error');
						});
						console.log($('span.red.label-error').length);
						$('span.red.error-label').each(function (index, val) {
							$(val).remove();
						});
					}
				},1000)
				// var error = $('<ul class="list"></ul>');
				// $.each(resp.responseJSON.errors, function(index, val) {
				// 	error.append('<li>'+val+'</li>');
				// });
				// $('#' + formid).find('.ui.error.message').html(error).show();
			}
		});
	}

	function saveDataNoAuth(formid) {
		// show loading
		$('#' + formid).find('.loading.dimmer').addClass('active');
		$('#cover').css('display','');
		$(window).unload();
		// begin submit
		$("#" + formid).ajaxSubmit({
			success: function(resp){
				$('#cover').css('display','none');
				window.onbeforeunload = null;

				var text = 'Data successfully saved.';
				var title = 'Saved!';
				swal({
					title:title,
					text:text,
					type:'success',
					allowOutsideClick: false,
					showCancelButton: false,

					confirmButtonColor: '#0052DC',
					confirmButtonText: 'Close',

					cancelButtonColor: '#6E6E6E',
					cancelButtonText: 'Print'
				}).then((result) => { // ok
					if(resp.url){
						location.href = '{!! url($pageUrl) !!}';
					}else{
						location.href = "{!! url('/') !!}/sc";
					}

				}, function(dismiss) { // cancel

				})
			},
			error: function(resp){
				$('#cover').css('display','none');
				$('#' + formid).find('.loading.dimmer').removeClass('active');
				// $('#cover').hide();
				var response = resp.responseJSON;
				if(response.error == 'message')
				{
						if(response.tab)
						{
								$('a[data-tab="'+response.tab+'"]').trigger('click');
								$('.ui.bottom.attached.tab.segment[data-tab="'+response.tab+'"]').prepend(`
									<div class="ui negative message">
										<i class="close icon"></i>
										<div class="header">
											We're sorry we can't save the record
										</div>
										<p>`+ response.message +`</p></div>
								`)
						}else{
						$('#' + formid).find('.ui.segment:first').prepend(`
							<div class="ui negative message">
								<i class="close icon"></i>
								<div class="header">
									We're sorry we can't save the record
								</div>
								<p>`+ response.message +`</p></div>
						`)
						}
				}
				$.each(response.errors, function(index, val) {
					clearFormError(index,val);
					showFormError(index,val);
				});
				time = 5;
				interval = setInterval(function(){
					time--;
					if(time == 0){
						clearInterval(interval);
						$('.pointing.prompt.label.transition.visible').fadeOut('slideUp', function(e) {
							$(this).remove();
						});
						$('#' + formid).find('.ui.segment:first').find('.ui.negative.message').remove();
						$('.error').each(function (index, val) {
							$(val).removeClass('error');
						});
						console.log($('span.red.label-error').length);
						$('span.red.error-label').each(function (index, val) {
							$(val).remove();
						});
					}
				},10000)
				// var error = $('<ul class="list"></ul>');
				// $.each(resp.responseJSON.errors, function(index, val) {
				// 	error.append('<li>'+val+'</li>');
				// });
				// $('#' + formid).find('.ui.error.message').html(error).show();
			}
		});
	}

	function cancelAction(element) {
		swal({
			title: 'Attention',
			html: $(element).data('message'),
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Confirm',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancel',
			reverseButtons: true,
		}).then((result) => {
			if (result) {
				$('#cover').css('display','');
				$.ajax({
					url: $(element).data('href'),
					type: 'GET',
				})
				.done(function(response) {
					$('#cover').css('display','none');
					if(response.status){
						swal({
							title: 'Successfully Canceled',
							text: " ",
							type: 'success',
							allowOutsideClick: false
						}).then((res) => {
							dt.draw('page');
							table.draw('page');
							return true;
						})
					}else{
						swal({
							title: 'Failed to Cancel',
							text: "your data cannot be canceled",
							type: 'error',
							allowOutsideClick: false
						}).then((res) => {
								dt.draw('page');
								return true;
						})
					}
				})
				.fail(function(response) {
					$('#cover').css('display','none');
					swal({
				    	title: 'Failed to Delete',
						text: "data is being used by another module",
						type: 'error',
						allowOutsideClick: false
				    }).then((res) => {

				    })
				})

			}
		})
	}

	function deleteData(url) {
		swal({
			title: 'Delete Data',
			html: "Are you sure you want to delete the data? <br>The data can not be returned.",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Confirm',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancel',
			reverseButtons: true,
		}).then((result) => {
			if (result) {
				$('#cover').css('display','');
				$.ajax({
					url: url,
					type: 'POST',
					// dataType: 'json',
					data: {
						'_method' : 'DELETE',
						'_token' : '{{ csrf_token() }}'
					}
				})
				.done(function(response) {
					$('#cover').css('display','none');
					if(response.status){
						swal({
							title: 'Successfully Deleted',
							text: " ",
							type: 'success',
							allowOutsideClick: false
						}).then((res) => {
							if(response.url){
								location.href = '{{ url($pageUrl) }}';
							}else if(response.redirect){
								if(response.redirect != '-'){
									showData(response.redirect);
									window.history.pushState("", "");
									gridFolder.draw();
								}else{
									location.href = '{{ url($pageUrl) }}';
								}

							}else if(response.reload){
								location.reload();
							}else{
								if(response.mod){
									table.draw();
        							e.preventDefault();
								}
								dt.draw('page');
								return true;
							}
						})
					}else{
						swal({
							title: 'Failed to Delete',
							text: "data is being used by another module",
							type: 'error',
							allowOutsideClick: false
						}).then((res) => {
							if(response.url){
								location.href = '{{ url($pageUrl) }}';
							}else if(response.redirect){
								if(response.redirect != '-'){
									showData(response.redirect);
									window.history.pushState("", "");
								}else{
									location.href = '{{ url($pageUrl) }}';
								}

							}else if(response.reload){
								location.reload();
							}else{
								if(response.mod){
									table.draw();
        							e.preventDefault();
								}
								dt.draw('page');
								return true;
							}
						})
					}
				})
				.fail(function(response) {
					$('#cover').css('display','none');
					swal({
				    	title: 'Failed to Delete',
						text: "data is being used by another module",
						type: 'error',
						allowOutsideClick: false
				    }).then((res) => {

				    })
				})

			}
		})
	}

	function approveData(url,labeled) {
		swal({
			title: "Confirmation",
			html: "Are you sure you want to "+labeled+" the data?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Confirm',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancel',
			reverseButtons: true,
		}).then((result) => {
			if (result) {
				$('#cover').css('display','');
				$.ajax({
					url: url,
					type: 'GET',
					// dataType: 'json',
					data: {
						'_method' : 'GET',
						'_token' : '{{ csrf_token() }}'
					}
				})
				.done(function(response) {
					$('#cover').css('display','none');
					if(response.status){
						swal({
							title: 'Successfully',
							text: " ",
							type: 'success',
							allowOutsideClick: false
						}).then((res) => {
							if(response.url){
								location.href = '{{ url($pageUrl) }}';
							}else if(response.redirect){
								if(response.redirect != '-'){
									showData(response.redirect);
									window.history.pushState("", "");
								}else{
									location.href = '{{ url($pageUrl) }}';
								}

							}else if(response.reload){
								location.reload();
							}else{
								if(response.mod){
									table.draw();
        							e.preventDefault();
								}
								dt.draw('page');
								return true;
							}
						})
					}else{
						swal({
							title: 'Failed',
							text: "data is being used by another module",
							type: 'error',
							allowOutsideClick: false
						}).then((res) => {
							if(response.url){
								location.href = '{{ url($pageUrl) }}';
							}else if(response.redirect){
								if(response.redirect != '-'){
									showData(response.redirect);
									window.history.pushState("", "");
								}else{
									location.href = '{{ url($pageUrl) }}';
								}

							}else if(response.reload){
								location.reload();
							}else{
								if(response.mod){
									table.draw();
        							e.preventDefault();
								}
								dt.draw('page');
								return true;
							}
						})
					}
				})
				.fail(function(response) {
					$('#cover').css('display','none');
					swal({
				    	title: 'Failed',
						text: " ",
						type: 'error',
						allowOutsideClick: false
				    }).then((res) => {

				    })
				})

			}
		})
	}

	function customeDeleteData(url) {
		swal({
			title: 'Delete Data',
			text: "Are you sure you want to delete the data? The data can not be returned.",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Confirm',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancel',
			reverseButtons: true,
		}).then((result) => {
			if (result) {
				$.ajax({
					url: url,
					type: 'POST',
					// dataType: 'json',
					data: {
						'_token' : '{{ csrf_token() }}'
					}
				})
				.done(function(response) {
					swal({
				    	title: 'Successfully Deleted',
						text: " ",
						type: 'success',
						allowOutsideClick: false
				    }).then((res) => {
				    	if(response.url){
							location.href = '{{ url($pageUrl) }}';
						}else if(response.redirect){
							if(response.redirect != '-'){
								showData(response.redirect);
								window.history.pushState("", "");
							}else{
								location.href = '{{ url($pageUrl) }}';
							}

						}else{
							dt.draw('page');
							return true;
						}
				    })
				})
				.fail(function(response) {
					swal({
				    	title: 'Failed to Delete',
						text: " ",
						type: 'error',
						allowOutsideClick: false
				    }).then((res) => {

				    })
				})

			}
		})
	}

	function loadModal(param) {
		var url    = (typeof param['url'] === 'undefined') ? '#' : param['url'];
		var modal  = (typeof param['modal'] === 'undefined') ? 'formModal' : param['modal'];
		var formId = (typeof param['formId'] === 'undefined') ? 'formData' : param['formId'];
		var onShow = (typeof param['onShow'] === 'undefined') ? function(){} : param['onShow'];
		var onApprove = (typeof param['onApprove'] === 'undefined') ? '' : param['onApprove'];

		$(modal).modal({
			bottom: 'auto',
			inverted: true,
			observeChanges: true,
			closable: false,
			detachable: false,
			autofocus: false,
			onApprove : function() {
				$(formId).form('validate form');
				if($(formId).form('is valid')){
					if (typeof onApprove === 'function') {
						onApprove();
					}else{
						$(modal).find('.loading.dimmer').addClass('active');
						$(formId).ajaxSubmit({
							timeout:15000,
							success: function(resp){
								var text = 'Data successfully saved.';
								if(resp.message)
								{
									text = resp.message;
								}
								if(resp.status){
									$(modal).modal('hide');
									swal(
									'Saved!',
									text,
									'success'
									).then((result) => {
										if(resp.url){
											location.href = '{{ url($pageUrl) }}';
										}else if(resp.redirect){
											if(resp.redirect != '-'){
												showData(resp.redirect);
												window.history.pushState("", "");
												gridFolder.draw('page');
											}else{
												location.href = '{{ url($pageUrl) }}';
											}
										}else if(resp.reload){
											location.reload();
										}else if(resp.toLogout == true){
											location.href = '{{ url("/login") }}';
										}else{
											if(resp.mod){
												table.draw();
												e.preventDefault();
											}
											dt.draw('page');
											return true;
										}
									})
								}else{
									if (typeof resp.message === "undefined") {
										var mes = 'Maybe this  data is being used';
									}else{
										var mes = resp.message;
									}
									$(modal).find('.loading.dimmer').removeClass('active');
									swal(
										'Failed Action!',
										mes,
										'error'
									);
								}

							},
							error: function(resp){
								$(modal).find('.loading.dimmer').removeClass('active');
								var response = resp.responseJSON;
								if(typeof response === 'undefined'){
									if(resp.status === 413){
										var messagefILE = 'Sorry your file is to large maximum uploaded {{ini_get('upload_max_filesize')}}B';

										swal(
										'Warning!',
										''+messagefILE,
										'error'
										);
									}else{
										var message = 'Please reselect the document';
										swal(
										'Warning!',
										''+message+'',
										'error'
										);
									}
								}else{
									if(resp.status === 800){
										var message = 'Please reselect the document';
										if(resp.responseJSON.errors){
											message = resp.responseJSON.errors;
										}
										swal(
										'Warning!',
										''+message,
										'error'
										);
									}else{
										$.each(response.errors, function(index, val) {
											clearFormError(index,val);
											showFormError(index,val);
										});
										time = 5;
										interval = setInterval(function(){
											time--;
											if(time == 0){
												clearInterval(interval);
												$('.pointing.prompt.label.transition.visible').fadeOut('slideUp', function(e) {
													$(this).remove();
												});
												$('.error').each(function (index, val) {
													$(val).removeClass('error');
												});
											}
										},1000)

									}

									// $(modal).find('.loading.dimmer').removeClass('active');
									// var error = $('<ul class="list"></ul>');

									// $.each(resp.responseJSON.errors, function(index, val) {
									// 	error.append('<li>'+val+'</li>');
									// });

									// if(resp.responseJSON.status=='errors'){
									// 	error.append('<li>'+resp.responseJSON.message+'</li>');
									// }

									// $(modal).find('.ui.error.message').html(error).show();
								}
							}
						});
					}
				}
				return false;
			},
			onShow: function(){
				$(modal).find('.loading.dimmer').addClass('active');
				$.get(url, { _token: "{{ csrf_token() }}" } )
				.done(function( response ) {
					$(modal).html(response);
					$('form').keypress(
					  function(event){
					    if (event.which == '13') {
					      event.preventDefault();
					    }
					});
					setTimeout(function(){
						$(modal).modal('refresh');
					},75);
					$('.ui.dropdown').dropdown();
					$('.ui.fluid.search.dropdown').dropdown({
						fullTextSearch: 'exact',
					});
					initModal();
					onShow();
					$(modal).parent().attr('style', 'display: flex !important');
				});
			},
			onHidden: function(){
				$(modal).parent().attr('style', 'display: flex !important');
				// if($(this).find('#deny').data('cek') == 'hide'){

				// }else{
					$(modal).html(`<div class="ui inverted loading dimmer">
						<div class="ui text loader">Loading</div>
					</div>`);
				// }
			}
		}).modal('show');
	}

	function postNewTab(url, param){
        var form = document.createElement("form");
        form.setAttribute("method", 'POST');
        form.setAttribute("action", url);
        form.setAttribute("target", "_blank");

        $.each(param, function(key, val) {
            var inputan = document.createElement("input");
                inputan.setAttribute("type", "hidden");
                inputan.setAttribute("name", key);
                inputan.setAttribute("value", val);
            form.appendChild(inputan);
        });

        document.body.appendChild(form);
        form.submit();

        document.body.removeChild(form);
    }

    function getNewTab(url){
        var win = window.open(url, '_blank');
  		win.focus();
    }

	function showFormError(key, value)
	{
		if(key.includes("."))
		{
			res = key.split('.');
			key = '';
			for(i=0; i < res.length; i++)
			{
				if(i == 0)
				{
					res[i] = res[i];
				}else{
					if(res[i] == 0)
					{
						res[i] = '\\[\\]';
					}else{
						res[i] = '['+res[i]+']';
					}
				}
				key += res[i];
			}
		}
		var myarr = value;
		for(var i=0; i < value.length; i++) {
		    myarr[i] = capitalize(value[i]);
		}
		var elm = $('#dataForm' + ' [name="' + key + '"]').closest('.field');
		var message = `<div class="ui basic red pointing prompt label transition visible">`+ myarr +`</div>`;
		var tabbing = $('#dataForm' + ' [name="' + key + '"]').parents('.tab.segment');
		var tabbingTampol = $('#dataForm' + ' [name="' + key + '"]').parents('.tab.tampol');

		if(tabbing.length > 0)
		{
			$('.tab.segment').removeClass('active');
			$('a.item').removeClass('active');
			$('a.item[data-tab="'+ tabbing.data('tab') +'"]').trigger('click');
			$('a.tab-ampas[data-tab="'+ tabbingTampol.data('tab') +'"]').trigger('click');
		}
		var showerror = $('#dataForm' + ' [name="' + key + '"]').closest('.field');
		var multipleCheckbox = $(showerror).parents('.multiple-checkbox');
		if(multipleCheckbox.length > 0)
		{
			multipleCheckboxLabel = multipleCheckbox.find('label:first-child');
			$(multipleCheckboxLabel).append('<span class="red error-label" style="color:#9f3a38 !important;">' + myarr + '</span>');
		}else{
			$(elm).addClass('error');
			$(showerror).append('<div class="ui basic red pointing prompt label transition visible">' + myarr + '</div>');
		}


	}

	function capitalize(str) {
		strVal = '';
		str = str.split(' ');
		for (var chr = 0; chr < str.length; chr++) {
			if(chr === 0){
				strVal += str[chr].substring(0, 1).toUpperCase() + str[chr].substring(1, str[chr].length) + ' ';
			}else{
				strVal += str[chr].substring(0, 1) + str[chr].substring(1, str[chr].length) + ' ';
			}
		}
		return strVal
	}

	function clearFormError(key, value)
	{
		if(key.includes("."))
		{
			res = key.split('.');
			key = '';
			for(i=0; i < res.length; i++)
			{
				if(i == 0)
				{
					res[i] = res[i];
				}else{
					if(res[i] == 0)
					{
						res[i] = '\\[\\]';
					}else{
						res[i] = '['+res[i]+']';
					}
				}
				key += res[i];
			}
		}
		var elm = $('#dataForm' + ' [name="' + key + '"]').closest('.field');
		var multipleCheckbox = $('#dataForm' + ' [name="' + key + '"]').closest('.field').parents('.multiple-checkbox');
		if(multipleCheckbox.length > 0)
		{
			multipleCheckboxLabel = multipleCheckbox.find('label:first-child');
			$(multipleCheckboxLabel).find('span.red.error-label').remove();
		}else{
			$(elm).removeClass('error');
			$('.ui.message').remove();
			var showerror = $('#dataForm' + ' [name="' + key + '"]').closest('.field').find('.ui.basic.red.pointing.prompt.label.transition.visible').remove();
		}
	}

	$(document).on('click', '.change-status.button', function(e){
		var id = $(this).data('id');
		var stat = $(this).data('stats');
		var msgs = 'Active!';
		if(stat == 'active'){
			msgs = 'Inactive!';
		}
		var url = $(this).data('url');
		swal({
			title: msgs,
			text: "Are you sure you changed the data?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Confirm',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancel',
			reverseButtons: true,
		}).then((result) => {
			if (result) {
				$.ajax({
					url: url,
					type: 'GET',
					data: {
						'_method' : 'GET',
						'_token' : '{{ csrf_token() }}'
					}
				})
				.done(function(response) {
					swal({
				    	title: 'Successfully changed',
						text: " ",
						type: 'success',
						allowOutsideClick: false
				    }).then((res) => {
				    	dt.draw('page');
				    })
				})
				.fail(function(response) {
					swal({
				    	title: 'Data Failed to Change',
						text: " ",
						type: 'error',
						allowOutsideClick: false
				    }).then((res) => {

				    })
				})

			}
		})
	});

	$(document).on('click', '.detail-page.button', function(e){
		var id = $(this).data('id');
		var url = "{{ url($pageUrl) }}/"+id;
		window.location = url;
	});

	$(document).on('click', '.save.as.page', function(e){
		swal({
			title: 'Are you sure you want to save this data?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Save',
			cancelButtonText: 'Cancel',
			reverseButtons: true
		}).then((result) => {
			if (result) {
				// $('#dataForm').find('input[name="status"]').val("1");
				saveData('dataForm');
			}
		})
	});

	$(document).on('click', '.save.as.no-auth', function(e){swal({
		title: 'Are you sure you want to save this data?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Save',
		cancelButtonText: 'Cancel',
		reverseButtons: true
		}).then((result) => {
			if (result) {
				// $('#dataForm').find('input[name="status"]').val("1");
				saveDataNoAuth('dataForm');
			}
		})
	});

	$(document).on('click', '.save.as.done', function(e){swal({
		title: 'Confirmation!',
		html: "Are you sure about the answers to all the questions that have been given??",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Sure',
		cancelButtonText: 'Cancel',
		reverseButtons: true
		}).then((result) => {
			if (result) {
				// $('#dataForm').find('input[name="status"]').val("1");
				saveData('dataForm');
			}
		})
	});

	$(document).on('click', '.ui.red.icon.button.hapus.file', function(e){
		var id = $(this).data('id');
		var tipe = $(e.target).parent().parent().find('input:text').data('types');
		if (tipe == "bulletin") {
			var url = '{{ url("master/bulletin/delete-lampiran")}}';
		}else{
			var url = '{{ url("master/policy/delete-lampiran")}}';
		}
		swal({
			title: 'Are you sure?',
			text: "Record cannot be retreive after deleted!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus',
			cancelButtonText: 'Batal'
		}).then((result) => {
			$('#lampiran-area').html(`<div class="ui active inverted dimmer">
				<div class="ui text loader">Loading</div>
				</div>`);
			if (result) {
				$.ajax({
					url: url,
					// type: 'GET',
				    type: 'POST',
				    data: {id: id, '_token': '{{csrf_token()}}'},
					success: function(resp){
						swal(
							'Deleted!',
							'Record has been deleted.',
							'success'
							).then(function(e){
								location.reload();
							});
						},
						error : function(resp){
							swal(
								'Gagal!',
								'Data gagal dihapus.',
								'error'
								).then(function(e){
							location.reload();
						});
							}
						});

			}
		})
	});

	function showLoadingInput(elemchild)
	{
		var loading = `<div class="ui active mini centered inline loader"></div>`;

		$('#'+elemchild).parent().closest('.field').addClass('disabled');
		$('#'+elemchild).parent().closest('.field').append(loading);
	}

	function  stopLoadingInput(elemchild)
	{
		// $('#'+elemchild).parent().closest('.field').find('.dropdown .delete').trigger('click');
		// $('#'+elemchild).parent('.dropdown').dropdown('clear');
		$('#'+elemchild).parent().closest('.field').removeClass('disabled');
		$('#'+elemchild).parent().closest('.field').find('.inline.loader').remove();
	}

	$(document).on('click', '.add-page.button', function(e){
		var url = "{{ url($pageUrl) }}/create";
		window.location = url;
	});

	$(document).on('click', '.edit-page.button', function(e){
		var id = $(this).data('id');
		var url = "{{ url($pageUrl) }}/"+id+"/edit";
		window.location = url;
	});

	$(document).on('click', '.detail-modal.button', function(e){
		var id = $(this).data('id');
		var url = $(this).data('url');
		event.preventDefault();
        // /* Act on the event */
        loadModal({
            'url' : url,
            'modal' : '.{{ $modalSize }}.modal',
            'formId' : '#dataForm',
            'onShow' : function(){
                onShow();
            },
        })
	});

	$(document).on('click', '.show-statistic.button', function(e){
		var id = $(this).data('id');
		// url($this->link.'show-statistic/'.$record->id)
		var url = "{{ url($pageUrl) }}/"+"show-statistic/"+id;
		window.location = url;
	});

	$(document).on('click', '.save.as.draft', function(e){
		$('#dataForm').find('input[name="status"]').val("0");
		saveData('dataForm');
	});

	$(document).on('click', '.print-pdf', function(e){
		window.open($(this).data('url'), '_blank');
	});

	$(document).on('click', '.save.as.published', function(e){swal({
		title: 'Are you sure this data is ready for publication ?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Publish',
		cancelButtonText: 'Cancel',
		reverseButtons: true,
	}).then((result) => {
			if (result) {
				$('#dataForm').find('input[name="status"]').val("1");
				saveData('dataForm');
			}
		})
	});

	$(document).on('click', '.ui.green.button.append-lampiran', function () {
		html = `<div class="sixteen wide column" style="padding: .5rem 0">
		<div class="ui fluid file input action">
		<input type="text" readonly>
		<input type="file" class="six wide column" name="attachment[]" autocomplete="off" multiple>
		<div class="ui button file">
		Cari...
		</div>
		<div class="ui red button remove-lampiran">
		Hapus &nbsp;&nbsp;
		</div>
		</div>
		</div>`;

		$(this).closest('.ui.inline.grid.field').append(html);
	});

	$(document).on('click', '.ui.red.button.remove-lampiran', function () {
		$(this).closest('.sixteen.wide.column').remove();
	});

	$(document).on('change', '.child.target', function () {
		var elemchild = $(this).find('select').data('child');
		var id = $(this).find('select').val();
		if(!id){
			id = '-';
		}
		showLoadingInput(elemchild);
		if(id != null)
		{
			$.ajax({
				url: '{{ url("option") }}/'+ elemchild +'/'+ id,
				type: 'GET',
				success: function(resp){
					stopLoadingInput(elemchild);
					$('#'+elemchild).html(resp);
					// $('#getType').attr('name','type_id_bangsat');
				},
				error : function(resp){

				}
			});
		}
	});

	$(document).on('change', '.child.only-name', function () {
		var elemchild = $(this).find('select').data('child');
		var id = $(this).find('select').val();
		showLoadingInput(elemchild);
		if(id != '' )
		{
			$.ajax({
				url: '{{ url("option") }}/'+ elemchild +'/'+ id,
				type: 'GET',
				success: function(resp){
					stopLoadingInput(elemchild);
					$('#'+elemchild).val(resp);
				},
				error : function(resp){

				}
			});
		}else{
			stopLoadingInput(elemchild);
		}
	});

	$(document).on('change', '.select.with.name', function () {
		var elemchild = [$(this).find('select').data('name'),$(this).find('select').data('select')];
		var id = $(this).find('select').val();
		showLoadingInput(elemchild);
		if(id != '' )
		{
			$.each(elemchild,function(k,v){
				$.ajax({
					url: '{{ url("option") }}/'+ v +'/'+ id,
					type: 'GET',
					success: function(resp){
						stopLoadingInput(v);
						$('#'+v).val(resp);
						if(v == 'getTypeComponent'){
							$('#'+v).html(resp);
						}
					},
					error : function(resp){

					}
				});
			});
		}else{
			stopLoadingInput(elemchild);
		}
	});
	$(document).on('click', '.review-page.button', function(e){
		var id = $(this).data('id');
		var url = "{{ url($pageUrl) }}/review/"+id;
		window.location = url;
	});

	$(document).on('click', '.revisi-page.button', function(e){
		var id = $(this).data('id');
		var url = "{{ url($pageUrl) }}/revised/"+id;
		window.location = url;
	});

	$(document).on('click', '.approve-page.button', function(e){
		var id = $(this).data('id');
		var url = "{{ url($pageUrl) }}/approve/"+id;
		window.location = url;
	});

</script>
