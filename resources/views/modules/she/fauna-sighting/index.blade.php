@extends('layouts.list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
@append

@section('js')
    <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>
@append

@section('filters')
<div class="field">
	<select id="company" name="filter[company]" class="ui fluid search dropdown companyChoise">
        {!! App\Models\Master\Site::options('name','id',[
          'filters' => [
            function ($site) {
                $site->whereIn('id', auth()->user()->site->pluck('id')->toArray());
              },
            ]
          ], 'Choose Company') !!}
      </select>
</div>
<div class="field startdate">
  <input type="text" placeholder="Start Date Taken" name="filter[date_start]">
</div>
<div class="field enddate">
  <input type="text" placeholder="End Date Taken" name="filter[date_end]">
</div>
{{-- <div class="field">
	<select id="type" name="filter[contractor]" class="ui fluid search dropdown">
    {!! App\Models\Master\Contractor::options('company','id',[], 'Choose Contractor') !!}
  </select>
</div> --}}

<button type="button" class="ui teal icon filter button" data-content="Cari Data">
	<i class="search icon"></i>
</button>
<button type="reset" class="ui icon reset button" data-content="Bersihkan Pencarian">
	<i class="refresh icon"></i>
</button>
@endsection

@section('js-filters')
d.company = $("select[name='filter[company]']").val();
d.start_date = $("input[name='filter[date_start]']").val();
d.end_date = $("input[name='filter[date_end]']").val();
@endsection

@section('toolbars')
  <button type="button" class="ui blue button download-summary">
        <i class="file icon"></i>
        Export Summary
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
  $(document).on('click', '.download-summary', function(event) {
    var company = $("select[name='filter[company]']").val();
    var start_date = $("input[name='filter[date_start]']").val();
    var end_date = $("input[name='filter[date_end]']").val();
    if((company === '') || (start_date === '') || (end_date === '')){
      swal(
        'Failed Action!',
        'Company and Date cannot be empty',
        'error'
      );
    }else{
      $('#cover').css('display','');
      site_name = $('.companyChoise option:selected').html();
      date_bitween = start_date+' Sampai '+end_date;
      $.ajax({
        url: '{{ url($pageUrl) }}/download-summary',
        type: "POST",
        data: {
          "_token":'{{ csrf_token() }}',
          'company':company,
          'start_date':start_date,
          'end_date':end_date,
        },
        xhrFields: {
            responseType: 'blob'  // without this, you will get blank pdf!
        },
        success: function(response){
          $('#cover').css('display','none');
          blob = new Blob([response], { type: 'application/octet-stream' });
          saveAs(blob, 'Fauna Sighting - '+site_name+' '+date_bitween+".zip");
          swal({
            title: 'Successfully',
            text: " ",
            type: 'success',
            allowOutsideClick: false
          }).then((result) => {
            dt.draw('page');
            return true;
          })
        },
        error : function(resp){
          var mes = 'Data not found.';
          swal(
              'Failed Action!',
              mes,
              'error'
            );
        },
      });
    }
  });
</script>
@endsection