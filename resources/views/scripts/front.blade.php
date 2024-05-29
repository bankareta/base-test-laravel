<script type="text/javascript">
	function goBack() {
		window.history.back();
	}
	$(document).ready(function() {
		$(window).keydown(function(event){
			if(event.keyCode == 13) {
			event.preventDefault();
			return false;
			}
		});
	});

	function saveData(formid) {
		// show loading
		$('#' + formid).find('.loading.dimmer').addClass('active');
		$('#cover').css('display','');
		$(window).unload();
		// begin submit
		$("#" + formid).ajaxSubmit({
			success: function(resp){
				$('#cover').css('display','none');
				var redirect = '{{ url('front/induction/show-induction') }}';
				if(resp.redirect)
				{
					redirect = resp.redirect;
				}
				swal({
					title:'Saved!',
					text:'Data successfully saved.',
					type:'success',
					allowOutsideClick: false,
					showCancelButton: false,

					confirmButtonColor: '#0052DC',
					confirmButtonText: 'Close',

					cancelButtonColor: '#6E6E6E',
					cancelButtonText: 'Print'
				}).then((result) => { // ok
					location.href = redirect;

				}, function(dismiss) { // cancel
					// if (dismiss === 'cancel') { // you might also handle 'close' or 'timer' if you used those
					// 	console.log('print 2')
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
				// var error = $('<ul class="list"></ul>');
				// $.each(resp.responseJSON.errors, function(index, val) {
				// 	error.append('<li>'+val+'</li>');
				// });
				// $('#' + formid).find('.ui.error.message').html(error).show();
			}
		});
	}

	function showFormError(key, value)
	{
		if(key.includes("."))
		{
			res = key.split('.');
			key = res[0] + '[' + res[1] + ']';
			if(res[1] == 0)
			{
				key = res[0] + '\\[\\]';
			}
		}
		var myarr = value;
		for(var i=0; i < value.length; i++) {
		    myarr[i] = capitalize(value[i]);
		}

		var elm = $('#dataForm' + ' [name=' + key + ']').closest('.field');
		$(elm).addClass('error');

		var message = `<div class="ui basic red pointing prompt label transition visible">`+ myarr +`</div>`;

		var showerror = $('#dataForm' + ' [name=' + key + ']').closest('.field');
		$(showerror).append('<div class="ui basic red left pointing prompt label transition visible" style="position:absolute;">' + myarr + '</div>');
	}

	function capitalize(str) {
		strVal = '';
		str = str.split(' ');
		for (var chr = 0; chr < str.length; chr++) {
			strVal += str[chr].substring(0, 1).toUpperCase() + str[chr].substring(1, str[chr].length) + ' '
		}
		return strVal
	}

	function clearFormError(key, value)
	{
		if(key.includes("."))
		{
			res = key.split('.');
			key = res[0] + '[' + res[1] + ']';
			if(res[1] == 0)
			{
				key = res[0] + '\\[\\]';
			}
			console.log(key);
		}
		var elm = $('#dataForm' + ' [name=' + key + ']').closest('.field');
		$(elm).removeClass('error');

		var showerror = $('#dataForm' + ' [name=' + key + ']').closest('.field').find('.ui.basic.red.pointing.prompt.label.transition.visible').remove();
	}

	$(document).on('click', '.save.as.page', function(e){swal({
		title: 'Are you sure you want to save this data?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Save',
		cancelButtonText: 'Cancel'
		}).then((result) => {
			if (result) {
				// $('#dataForm').find('input[name="status"]').val("1");
				saveData('dataForm');
			}
		})
	});
</script>
