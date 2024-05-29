<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">{!! $title or '-' !!}</div>
<div class="content">
	<div class="ui top attached tabular menu">
		<a class="tab-set item active" data-type="trans-stock" data-tab="1"><i class="server icon"></i> Transactions</a>
		<a class="tab-set item" data-type="update-stock" data-tab="2"><i class="server icon"></i> Restock</a>
	</div>
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		{!! csrf_field() !!}
		<input type="hidden" id="type-trans" name="type" value="trans-stock">
		<div class="ui bottom attached tab segment active" data-tab="1">
			<div class="field yearTrans">
				<label>Tahun</label>
				<input type="text" id="yearTrans" name="year_trans" placeholder="Tahun">
			</div>
			<div class="field">
				<label>Company</label>
				<select id="companyChoiseTrans" name="site_trans_id" class="ui class dropdown">
					{!! App\Models\Master\Site::options('name','id',['filters' => [
						function ($site) {
							$site->whereIn('id', auth()->user()->site->pluck('id')->toArray());
						},
						]
					], 'Choose One') !!}
				</select>
			</div>
			<div class="field">
				<label>Nama Obat</label>
				<select class="ui fluid search dropdown" id="medicineTrans" name="medicine_trans_id">
					
				</select>
			</div>
			<div class="field">
				<label>Expire Date</label>
				<select class="ui fluid search dropdown" id="expireTrans" name="expire_date_trans">
					
				</select>
			</div>
			<div class="field">
				<label>Jumlah Stok /Expire Date(pcs)</label>
				<input type="number" readonly id="totalExpireStok" value="0" placeholder="Jumlah Total Stok /Expire Date (pcs)">
			</div>
			<div class="field">
				<label>Jumlah Total Stok (pcs)</label>
				<input type="number" readonly id="totalStok" value="0" placeholder="Jumlah Total Stok (pcs)">
			</div>
			<div class="field">
				<label>Transaksi (pcs)</label>
				<input type="number" name="trans_stock" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')" min="1" placeholder="Transaksi (pcs)">
			</div>      
		</div>
		<div class="ui bottom attached tab segment" data-tab="2">
			<div class="field yearStock">
				<label>Tahun</label>
				<input type="text" id="year" name="year" readonly placeholder="Tahun">
			</div>
			<div class="field">
				<label>Company</label>
				<select id="companyChoise" name="site_id" class="ui class dropdown">
					{!! App\Models\Master\Site::options('name','id',['filters' => [
						function ($site) {
							$site->whereIn('id', auth()->user()->site->pluck('id')->toArray());
						},
						]
					], 'Choose One') !!}
				</select>
			</div>
			<div class="field">
				<label>Nama Obat</label>
				<select class="ui fluid search dropdown" id="medicine" name="medicine_id">
					
				</select>
			</div>
			<div class="field date">
				<label>Expire Date</label>
				  <input type="text" name="expire_date" readonly placeholder="Expire Date">
			</div>
			<div class="field">
				<label>Jumlah Stok (pcs)</label>
				<input type="number" readonly id="totalStokExist" value="0" placeholder="Jumlah Stok (pcs)">
			</div>
			<div class="field">
				<label>Tambah Stok (pcs)</label>
				<input type="number" name="stock" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')" min="1" placeholder="Tambah Stok (pcs)">
			</div>   
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
