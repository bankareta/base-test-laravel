<script type="text/javascript">
	var hari   = 0;
	var harian = 0;
	var total 	= 0 ;
	jumlah = function(){
		var hari   = $("[name=jml_hari]").val();
		var harian = $("[name=harian]").val();
		total = hari * harian;
		$('[name=total]').val(total);
	}
</script>
<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create Data SPPD</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		<div class="ui error message">
		</div>
		{!! csrf_field() !!}
	  <div class="field">
	    <div class="two fields">
	      <div class="field">
	    	<label>Kirim Ke</label>
				<select name="kirim_ke" class="ui fluid dropdown">
					@foreach ($option_user as $val)
						<option value="{{ $val->id }}">{{ $val->username }}</option>
					@endforeach
				</select>
	        {{-- <input name="kirim_ke" placeholder="Kirim Ke" type="text"> --}}
	      </div>
	      <div class="field">
	    	<label>Project</label>
	        <input name="project" placeholder="Project" type="text">
	      </div>
	    </div>
	  </div>
	  <div class="field">
	    <div class="two fields">
	      	<div class="field">
	    		<label>Tujuan</label>
	        	<input name="tujuan" placeholder="Tujuan" type="text">
	      	</div>
	      	<div class="field">
		      	<div class="two fields">
			  	    <div class="field">
			  	  	<label>Tanggal Awal</label>
						<div class="ui calendar" id="to">
							<div class="ui input left icon">
								<i class="calendar icon"></i>
								<input type="text" placeholder="Sampai Bulan" name="tgl_awal"  placeholder="Tangggal Awal" value="">
							</div>
						</div>
			  	    </div>
			  	    <div class="field">
			  	  	<label>Tanggal Akhir</label>
			  	      	<div class="ui calendar" id="to">
							<div class="ui input left icon">
								<i class="calendar icon"></i>
								<input type="text" placeholder="Sampai Bulan" name="tgl_akhir"  placeholder="Tangggal Akhir" value="">
							</div>
						</div>
			  	    </div>
		      	</div>
	  		</div>
	    </div>
	  </div>
	  <div class="field">
	    <div class="two fields">
	      	<div class="field">
		      	<div class="Three fields">
			  	    <div class="field">
			  	  	  	<label>Jumlah Hari</label>
			  	      	<input name="jml_hari" placeholder="Jumlah Hari" type="text">
			  	    </div>
		      	</div>
	  		</div>
	      	<div class="field">
		      	<div class="two fields">
			  	    <div class="field">
			  	  		<label>Harian</label>
			  	      <input name="harian" placeholder="Harian" onkeyup="jumlah();" type="text">
			  	    </div>
			  	    <div class="field">
			  	  		<label>Total</label>
			  	      <input name="total" placeholder="Total" type="text" readonly style="background: #E8FFBC">
			  	    </div>
		      	</div>
	  		</div>
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