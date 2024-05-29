@extends('layouts.list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
@append

@section('js')
    <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>
@append

@section('filters')
<div class="field">
	<input type="text" name="filter[list]"  placeholder="List" value="">
</div>

<button type="button" class="ui teal icon filter button" data-content="Cari Data">
	<i class="search icon"></i>
</button>
<button type="reset" class="ui icon reset button" data-content="Bersihkan Pencarian">
	<i class="refresh icon"></i>
</button>
@endsection

@section('js-filters')
d.list = $("input[name='filter[list]']").val();
@endsection

@section('toolbars')
	   <button type="button" class="ui blue @if($pagePerms != '' && !auth()->user()->can($pagePerms.'-add')) disabled @endif button add">
            <i class="add icon"></i>
            Create New Data
        </button>
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

@section('scripts')
<script>
	$(document).on('click', '.copy-invit.button', function(event) {
    	event.preventDefault();
		var idToCopy = atob($(this).data('id'));
		navigator.clipboard.writeText(idToCopy)
		.then(function() {
			alert("Link telah disalin");
		})
		.catch(function() {
			alert("Tidak dapat menyalin");
		});
	});
	initModal = function(){
		$('.add-child').on('click', function(e){
			parent = $('#show-child');
			len = $('.child-data').lenght;
			htm = `
			<div class="three fields">
				<div class="field">
					<label>Nama Tamu Undangan</label>
					<input type="text" name="name[]" placeholder="Nama Tamu Undangan">
				</div>
				<div class="field">
					<label>No. Whatsapp</label>
					<input type="text" name="no_telp[]" placeholder="No. Whatsapp">
				</div>
				<div class="field">
					<label>Undangan Dari Pihak</label>
					<select name="from[]" class="ui fluid search dropdown child">
						<option value="">Choose One</option>
						<option value="male">Laki-laki</option>
						<option value="female">Perempuan</option>
					</select>
				</div>
			</div>
			`;
			parent.append(htm);
			$('.dropdown.child').dropdown();
			$('.dropdown.child').dropdown('refresh');
		});
	}
</script>
@endsection
