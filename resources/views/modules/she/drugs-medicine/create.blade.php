<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create New {!! $title or '-' !!}</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		{!! csrf_field() !!}
	  	<div class="field">
	  		<label>Company</label>
	  		<select id="site_id" name="site_id" class="ui class dropdown">
				{!! App\Models\Master\Site::options('name','id',['filters' => [
					function ($site) {
						$site->whereIn('id', auth()->user()->site->pluck('id')->toArray());
					},
					]
				], 'Choose One') !!}
			</select>
		</div>
	  	<div class="field year">
			<label>Tahun</label>
	  		<input type="text" name="year" readonly placeholder="Tahun">
		</div>
		<div class="field">
			<label>Nama Obat</label>
			<select class="ui fluid search dropdown" name="medicine_id">
				{!! App\Models\Master\Medicine::options('name','id',[], 'Choose One') !!}
			</select>
		</div>
		<div class="field">
			<label>Merk Dagang</label>
			<select class="ui fluid search dropdown" name="trademark_id">
				{!! App\Models\Master\Trademark::options('name','id',[], 'Choose One') !!}
			</select>
		</div>
		<div class="field">
			<label>Sediaan / Unit</label>
			<select class="ui fluid search dropdown" name="unit_id">
				{!! App\Models\Master\UnitMedicine::options('name','id',[], 'Choose One') !!}
			</select>
		</div>
		<div class="field">
			<label>Route</label>
			<select class="ui fluid search dropdown" name="route_id">
				{!! App\Models\Master\RouteMedicine::options('name','id',[], 'Choose One') !!}
			</select>
		</div>
		<div class="field">
			<label>Dosis (gr)</label>
	  		<input type="number" name="dose" step="0.01" placeholder="Dosis (gr)">
		</div>
		<div class="field">
			<label>Minimal Stok (pcs)</label>
	  		<input type="number" name="min_stock" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')" min="1" placeholder="Minimal Stok (pcs)">
		</div>
	</form>
</div>
<div class="actions">
	<div class="ui black deny button">
		Cancel
	</div>
	<div class="ui positive right labeled icon save button">
		Save
		<i class="checkmark icon"></i>
	</div>
</div>
