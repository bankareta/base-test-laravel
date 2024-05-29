@extends('layouts.form')

@section('styles')
<style type="text/css">
</style>
@endsection

@section('scripts')
<script type="text/javascript">
    $('.dateArive').calendar({
        type: 'date',
        monthFirst: true,
        initialDate: new Date(),
        maxDate: new Date(),
        onChange: function(date, text, mode) {
          $('.dateExit').calendar({
            type: 'date',
            ampm: false,
            monthFirst: true,
            initialDate: new Date(),
            // maxDate: new Date(),
            minDate: date
          })
        }
    });
    $('.dateExit').calendar({
        type: 'date',
        monthFirst: true,
        initialDate: new Date(),
        // maxDate: new Date(),
        onChange: function(date, text, mode) {
          $('.dateArive').calendar({
            type: 'date',
            maxDate: date
          })
        }
    });

    $('.maxdate').calendar({
      type: 'date',
      initialDate: new Date(),
      maxDate: new Date(),
      text: {
      },
    });

    $(document).ready(function () {
      $(document).on('change', '#lampiran-first', function(e){
        var fileExtension = ['png','jpg','jpeg','pdf'];
        if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1){
          swal({
				    	title: 'Incorrect format',
              text: "Files must be in the form of images and pdf",
              type: 'error',
              allowOutsideClick: false
          }).then((res) => {
            $('#lampiran-first-text').val('');
            $(this).val('');
          })
        }else{
          if(this.files[0].size < 10933862){

          }else{
            swal({
                title: "Size doesn't fit",
                text: "Max Size File 10MB",
                type: 'error',
                allowOutsideClick: false
            }).then((res) => {
              $('#lampiran-first-text').val('');
              $(this).val('');
            })
          }
        }
      });
      $(document).on('change', '#propose', function(e){
        switch ($(this).val()) {
          case 'employee':
              $('#userAssign').hide();
              $('#employee').show();
              $("input[name='mail_employee']").val('');
            break;
          case 'assigned':
              $('#employee').hide();
              $('#userAssign').show();
              $("input[name='mail_employee']").val('');
            break;
          default:
            $('#employee').hide();
            $('#userAssign').hide();
            $("input[name='mail_employee']").val('');
            break;
        }
      });

      $(document).on('change', '.companyChoise', function(e){
        $('#employee').dropdown('clear');
        $('#assign').dropdown('clear');
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
              
              $('#assign').html(resp.data_assign);
              $('#assign').dropdown();
              $('#assign').dropdown('refresh');
          },
          error : function(resp){

          },
        });
      });
    });
</script>
@endsection

@section('content-body')
<form id="dataForm" action="{{ url($pageUrl) }}" class="ui form" method="POST">
  <div class="ui form">
    {!! csrf_field() !!}
    <div class="ui segment">
      <div class="three fields">
        <div class="field">
          <label>Site</label>
          <select id="site_id" name="site_id" class="ui class companyChoise dropdown">
              {!! App\Models\Master\Site::options('name','id',['filters' => [
                function ($site) {
                    $site->whereIn('id', auth()->user()->site->pluck('id')->toArray());
                  },
                ]
              ], 'Choose One') !!}
          </select>
          <input type="hidden" name="name" placeholder="Contractor Name" value="-">
        </div>
        <div class="field">
          <label>Company</label>
          <input type="text" name="company" placeholder="Company">
        </div>
        <div class="field">
          <label>Department</label>
          <input type="text" name="department" placeholder="Department">
        </div>
      </div>

      <div class="three fields">
        <div class="field">
          <label>Employee Name</label>
          <select id="employee" name="user_id" class="ui fluid search dropdown">
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
                ]], 'Choose One') !!}
          </select>
        </div>
        <div class="field">
          <label>Employee ID</label>
          <input type="text" name="employee_id" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')" placeholder="Employee ID">
        </div>
        <div class="field">
          <label>Job Position</label>
          <input type="text" name="title" placeholder="Job Position">
        </div>
      </div>
      
      <div class="three fields">
        <div class="field">
          <label>Sex / Gender</label>
          <select class="ui fluid search dropdown" name="gender">
            <option value="">Choose One</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
        <div class="field">
          <label>Blood</label>
          <select class="ui fluid search dropdown" name="blood_id">
            {!! App\Models\Master\Blood::options('name','id',[], 'Choose One') !!}
          </select>
        </div>
        <div class="field maxdate">
          <label>Date of Birth</label>
          <input type="text" name="date_birth" placeholder="Date of Birth" readonly="">
        </div>
      </div>
      
      <div class="three fields">
        <div class="field">
          <label>MCU Provider</label>
          <input type="text" name="provider" placeholder="MCU Provider">
        </div>
        <div class="field">
          <label>MCU Type</label>
          <select class="ui fluid search dropdown" name="type_id">
            {!! App\Models\Master\TypeMcu::options('name','id',[], 'Choose One') !!}
          </select>
        </div>
        <div class="field" id="userAssign">
          <label>Assign Propose MCU to</label>
          <select id="assign" name="assign_id" class="ui fluid search dropdown">
            {!! App\Models\Authentication\User::options(function ($user) {
              return $user->email;
            }, 'id', ['filters' => [
                  function ($site) {
                      $site->where('status', '1');
                  },
                  function ($site) {
                      $site->whereHas('site', function ($s) {
                          $s->whereIn('id', auth()->user()->site->pluck('id')->toArray());
                      });
                  },
                ]], 'Choose One') !!}
          </select>
        </div>
      </div>
      <div class="field">
        <label>Attachment </label>
        <div class="ui fluid file input action">
          <input type="text" id="lampiran-first-text" readonly>
          <input type="file" class="six wide column" id="lampiran-first" name="foto" accept="application/pdf,image/*" autocomplete="off">
          <div class="ui button file">
            Browse...
          </div>
        </div>
      </div>
      <div class="ui two column grid">
        <div class="left aligned column">
          <a class="ui labeled icon button" href="{{ url($pageUrl) }}">
            <i class="chevron left icon"></i>
            Back
          </a>
        </div>
        <div class="right aligned column">
          <div class="ui positive right labeled icon save as page button">
            Save
            <i class="checkmark icon"></i>
          </div>
        </div>
      </div>
    </div>

  </div>

</form>
@endsection
