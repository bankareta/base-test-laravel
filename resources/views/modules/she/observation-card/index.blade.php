@extends('layouts.list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
@append

@section('js')
    <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>
@append

@section('filters')
<div class="field">
	<select id="company" name="filter[company]" class="ui fluid search dropdown">
        {!! App\Models\Master\Site::options('name','id',[
          'filters' => [
            function ($site) {
                $site->whereIn('id', auth()->user()->site->pluck('id')->toArray());
              },
            ]
          ], 'Choose Company') !!}
  </select>
</div>
<div class="field">
	<select id="department" name="filter[department]" class="ui fluid search dropdown">
        {!! App\Models\Master\Departemen::options('name','id',[
          'filters' => [
            function ($site) {
                $site->whereIn('site_id', auth()->user()->site->pluck('id')->toArray());
              },
            ]
          ], 'Choose Department') !!}
  </select>
</div>
<div class="field">
	<select id="pic" name="filter[pic]" class="ui fluid search dropdown">
        {!! App\Models\Master\Departemen::options('name','id',[
          'filters' => [
            function ($site) {
                $site->whereIn('site_id', auth()->user()->site->pluck('id')->toArray());
              },
            ]
          ], 'Choose PIC Department') !!}
  </select>
</div>
<div class="field">
	<select id="finding" name="filter[finding]" class="ui fluid search dropdown">
    <option value="">Choose Finding</option>
    <option value="1">Unsafe Action</option>
    <option value="2">Unsafe Condition</option>
    <option value="3">Positive Observation</option>
  </select>
</div>
<div class="field startdate">
  <input type="text" placeholder="Start Observed Date" name="filter[date_start]">
</div>
<div class="field enddate">
  <input type="text" placeholder="End Observed Date" name="filter[date_end]">
</div>


<button type="button" class="ui teal icon filter button" data-content="Cari Data">
	<i class="search icon"></i>
</button>
<button type="reset" class="ui icon reset button" data-content="Bersihkan Pencarian">
	<i class="refresh icon"></i>
</button>
@endsection

@section('js-filters')
d.start_date = $("input[name='filter[date_start]']").val();
d.end_date = $("input[name='filter[date_end]']").val();
d.company = $("select[name='filter[company]']").val();
d.department = $("select[name='filter[department]']").val();
d.pic = $("select[name='filter[pic]']").val();
d.finding = $("select[name='filter[finding]']").val();
@endsection

@section('toolbars')
	   <button type="button" class="ui blue @if($pagePerms != '' && !auth()->user()->can($pagePerms.'-add')) disabled @endif button add-page">
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
  $(document).ready(function () {
    closeSidebar();
  });
  $(document).on('click', '.send-notif', function(event) {
    id = $(this).data('id');
    swal({
      title: "Send Notification",
      text: "Do you want to send a notification to the PIC Department?",
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Send Notification',
      reverseButtons: true,
      cancelButtonText: 'Cancel'
			}).then((result) => {
        $('#cover').css('display','');
        $.ajax({
          url: '{{ url($pageUrl) }}/send-notification',
          type: "POST",
          data : {
            "_token":'{{ csrf_token() }}',
            'id':id,
          },
          success: function(response){
            $('#cover').css('display','none');
            swal({
              title: 'Successfully',
              text: " ",
              type: 'success',
              allowOutsideClick: false
            }).then((result) => {
              // location.reload();
              return true;
            })
          },
          error : function(resp){
            $('#cover').css('display','none');
            var mes = '';
            swal(
                'Failed Action!',
                mes,
                'error'
              );
          },
        });
    })
  });
  $(document).on('change', '#company', function(e){
        $('#department').dropdown('clear');
        $('#pic').dropdown('clear');
        var val = $('#company option:selected').val();
        if(!val){
          val = '-';
        }
        var url = '{{ url($pageUrl.'filter-location/') }}';
        $.ajax({
          url: url+'/'+val,
          type: "GET",
          dataType: 'json',
          processData: false,
          contentType: false,
          success: function(resp){
              $('#department').html(resp.depart);
              $('#department').dropdown();
              $('#department').dropdown('refresh');
              
              $('#pic').html(resp.depart);
              $('#pic').dropdown();
              $('#pic').dropdown('refresh');
          },
          error : function(resp){

          },
        });
      });
</script>
@endsection
