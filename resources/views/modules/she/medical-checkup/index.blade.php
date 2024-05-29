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
<div class="field">
	<select id="employee" name="filter[employee_id]" class="ui fluid search dropdown">
    {!! App\Models\Authentication\User::options(function ($user) {
      return $user->display;
    }, 'id', ['filters' => [
          function ($site) {
              $site->where('status', '1');
          },
          function ($site) {
              $site->whereHas('site', function ($s) {
                  $s->whereIn('id', auth()->user()->site->pluck('id')->toArray());
              });
          },
        ]], 'Choose Employee') !!}
  </select>
</div>
<div class="field">
	<input type="text" name="filter[department]"  placeholder="Department" value="">
</div>
<div class="field startdate">
  <input type="text" placeholder="Start Filter Due Date" name="filter[date_start]">
</div>
<div class="field enddate">
  <input type="text" placeholder="End Filter Due Date" name="filter[date_end]">
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
d.department = $("input[name='filter[department]']").val();
d.company = $("select[name='filter[company]']").val();
d.employee_id = $("select[name='filter[employee_id]']").val();
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
  $(document).on('click', '.send-notif', function(event) {
    id = $(this).data('id');
    swal({
      title: "Send Notification",
      text: "Do you want to send a notification to the assigned?",
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
              location.reload();
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

  $(document).on('change', '.companyChoise', function(e){
        $('#employee').dropdown('clear');
        var val = $('.companyChoise option:selected').val();
        if(!val){
          val = '-';
        }
        var url = '{{ url($pageUrl.'filter-employee/') }}';
        $.ajax({
          url: url+'/'+val,
          type: "GET",
          dataType: 'json',
          processData: false,
          contentType: false,
          success: function(resp){
              $('#employee').html(resp.data);
              $('#employee').dropdown();
              $('#employee').dropdown('refresh');
          },
          error : function(resp){

          },
        });
      });
</script>
@endsection
