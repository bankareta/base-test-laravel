@extends('layouts.form')

@section('styles')

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
<form id="dataForm" action="{{ url($pageUrl.$record->id) }}" class="ui form" method="POST">
  <div class="ui form">
    {!! csrf_field() !!}
    <input type="hidden" name="id" value="{{ $record->id }}">
    <input type="hidden" name="_method" value="PUT">
    <div class="ui segment">
      <div class="three fields">
        <div class="field">
          <label>Site</label>
          <select id="site_id" name="site_id" class="ui class companyChoise dropdown">
              {!! App\Models\Master\Site::options('name','id',[
                'selected' => $record->site_id,
                'filters' => [
                function ($site) {
                    $site->whereIn('id', auth()->user()->site->pluck('id')->toArray());
                  },
                ]
              ], 'Choose One') !!}
          </select>
        </div>
        <div class="field">
          <label>Company</label>
          <input type="text" name="company" placeholder="Company" value="{{ $record->company or '' }}">
          <input type="hidden" name="name" placeholder="Contractor Name" value="{{ $record->name }}">
        </div>
        <div class="field">
          <label>Department</label>
          <input type="text" name="department" placeholder="Department" value="{{ $record->department or '' }}">
        </div>
      </div>
      <div class="three fields">
        <div class="field">
          <label>Employee Name</label>
          <select id="employee" name="user_id" class="ui fluid search dropdown">
            {!! App\Models\Authentication\User::options(function ($user) {
              return $user->display;
            }, 'id', ['selected' => $record->user_id,'filters' => [
                  function ($site) {
                      $site->where('status', '1');
                  },
                  function ($site) use ($record) {
                      $site->whereHas('site', function ($s) use ($record){
                          $s->where('id', $record->site_id);
                      });
                  },
                ]], 'Choose One') !!}
          </select>
        </div>
        <div class="field">
          <label>Employee ID</label>
          <input type="text" name="employee_id" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')" placeholder="Employee ID" value="{{ $record->employee_id or '' }}">
        </div>
        <div class="field">
          <label>Job Position</label>
          <input type="text" name="title" placeholder="Job Position" value="{{ $record->title or '' }}">
        </div>
      </div>
      <div class="three fields">
        <div class="field">
          <label>Sex / Gender</label>
          <select class="ui fluid search dropdown" name="gender">
            <option value="">Choose One</option>
            <option {{ $record->gender == 'Male' ? 'selected':'' }} value="Male">Male</option>
            <option {{ $record->gender == 'Female' ? 'selected':'' }} value="Female">Female</option>
          </select>
        </div>
        <div class="field">
          <label>Blood</label>
          <select class="ui fluid search dropdown" name="blood_id">
            {!! App\Models\Master\Blood::options('name','id',['selected' => $record->blood_id], 'Choose One') !!}
          </select>
        </div>
        <div class="field maxdate">
          <label>Date of Birth</label>
          <input type="text" name="date_birth" placeholder="Date of Birth" readonly="" value="{{ $record->date_birth or '' }}">
        </div>
      </div>
      
      <div class="three fields">
        <div class="field">
          <label>MCU Provider</label>
          <input type="text" name="provider" placeholder="MCU Provider" value="{{ $record->provider or '' }}">
        </div>
        <div class="field">
          <label>MCU Type</label>
          <select class="ui fluid search dropdown" name="type_id">
            {!! App\Models\Master\TypeMcu::options('name','id',['selected' => $record->type_id], 'Choose One') !!}
          </select>
        </div>
        <div class="field" id="userAssign">
          <label>Assign Propose MCU to</label>
          <select id="assign" name="assign_id" class="ui fluid search dropdown">
            {!! App\Models\Authentication\User::options(function ($user) {
              return $user->display;
            }, 'id', [
              'selected' => $record->mail->user_id,
              'filters' => [
                  function ($site) {
                      $site->where('status', '1');
                  },
                  function ($site) use ($record) {
                      $site->whereHas('site', function ($s) use ($record){
                          $s->where('id', $record->site_id);
                      });
                  },
                ]], 'Choose One') !!}
          </select>
        </div>
      </div>
      <div class="field">
        <label>Attachment {!! $record->primaryFiles ? '<a href="'.asset('storage/'.$record->primaryFiles->url).'" download="'.$record->primaryFiles->filename.'" target="_blank">(Download File)</a>':'' !!}</label>
        <div class="ui fluid file input action">
          <input type="text" id="lampiran-first-text" value="{{ $record->primaryFiles->filename }}" readonly>
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
