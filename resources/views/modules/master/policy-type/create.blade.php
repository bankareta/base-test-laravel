<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">
	{{-- {{trans('translator.Buat')}} {{trans('translator.Tipe Bulletin & Alert')}} --}}
	Create New Policy & Procedure Type
</div>
<div class="content">
	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		{!! csrf_field() !!}
		<div class="ui form">
			<div class="field">
				{{-- <label>{{trans('translator.Tipe Bulletin & Alert')}}</label> --}}
				<label>Policy & Procedure Type</label>
				{{-- <input type="text" name="name" placeholder="{{trans('translator.Tipe Bulletin & Alert')}}" value="{{ old('name') or '' }}"> --}}
				<input type="text" name="name" placeholder="Policy & Procedure Type" value="{{ old('name') or ''}}">
			</div>
			<div class="field">
				{{-- <label>{{trans('translator.Deskripsi')}}</label> --}}
				<label>Description</label>
				{{-- <textarea name="description" placeholder="{{trans('translator.Deskripsi')}}">{!! old('description') or '' !!}</textarea> --}}
				<textarea name="description" placeholder="Description">{!! old('description') or '' !!}</textarea>
			</div>
		</div>
	</form>
</div>
<div class="actions">
	<div class="ui black deny button">
		{{-- {{trans('translator.Kembali')}} --}}
		Back
	</div>
	<div class="ui positive right labeled icon save button">
		{{-- {{trans('translator.Simpan')}} --}}
		Save
		<i class="save icon"></i>
	</div>
</div>
