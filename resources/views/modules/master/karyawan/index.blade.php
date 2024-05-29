@extends('layouts.list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
@append

@section('js')
    <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>
@append

@section('filters')
<div class="field">
	<div class="ui month" id="to">
		<div class="ui input left icon">
			<i class="calendar icon"></i>
			<input type="text" name="filter[bulan]"  placeholder="Month & year" value="">
		</div>
	</div>
	<!-- <input name="filter[bulan]" class="ui month" placeholder="Month & year" type="text"> -->
</div>
<div class="field">
	<select name="filter[status]" >
			<option value="">-- All --</option>
			<option value="0">Draf</option>
			<option value="1">Kirim</option>
			<option value="2">Bayar</option>
			<option value="3">Tolak</option>
	</select>
</div>
<button type="button" class="ui teal icon filter button" data-content="Find Data">
	<i class="search icon"></i>
</button>
<button type="reset" class="ui icon reset button" data-content="Clear Search">
	<i class="refresh icon"></i>
</button>
@endsection

@section('js-filters')
d.bulan = $("input[name='filter[bulan]']").val();
d.status = $("select[name='filter[status]']").val();
@endsection

@section('toolbars')
@endsection

@section('rules')
<script type="text/javascript">
	formRules = {
		judul: 'empty',
		sub_judul: 'empty',
		url: 'url',
	};
</script>
@endsection

@section('init-modal')
<script>
	$(document).ready(function() {
		$('.ui.month').calendar({
			type: 'month'
		});
		
		$('.ui.add.button').on('click', function(event) {
			event.preventDefault();
			// /* Act on the event */
			loadModal({
				'url' : '{{ url($pageUrl) }}/create',
				'modal' : '.large.modal',
				'formId' : '#dataForm',
				'onShow' : function(){ 
					// console.log('fungsi dari script')
					$('.ui.calendar').calendar(calendarOpts);
				},
			})
		});

		bayar = function(id, tipe){
			loadModal({
				'url' : '{{ url($pageUrl) }}/'+id+'/'+tipe,
				'modal' : '.large.modal',
				'formId' : '#dataForm',
				'onShow' : function(){ 
					// console.log('fungsi dari script')
					$('.ui.calendar').calendar(calendarOpts);
				},
			})
		}
		
		editModal = function(id){
			loadModal({
				'url' : '{{ url($pageUrl) }}/'+id+'/edit',
				'modal' : '.large.modal',
				'formId' : '#dataForm',
				'onShow' : function(){ 
					// console.log('fungsi dari script')
					$('.ui.calendar').calendar(calendarOpts);
				},
			})
		}

		confirm = function(id){
			swal({
			  title: 'Yakin akan mengirim data ?',
			  text: "Pastikan data ini sudah benar dan  tidak ada kesalahan!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Kirim'
			}).then((result) => {
			  $.ajax({
			  	url: '{{ url($pageUrl) }}/confirm',
			  	type: 'POST',
			  	data: {id: id},
			  })
			  .done(function() {
				    swal(
				      'Terkirim !',
				      'Data berhasil di kirim.',
				      'success'
				    )
				    .then((result) => {
								dt.draw('page');
								return true;
					})
			  })
			  .fail(function() {
				    swal(
				      'Gagal !',
				      'Data gagal di kirim.',
				      'error'
				    )
			  })
			  .always(function() {
			  	console.log("complete");
			  });
			})
		}
	});

</script>
@endsection