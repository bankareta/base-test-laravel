@extends('layouts.form')

@section('styles')

@endsection

@section('scripts')
<script type="text/javascript">
  initModal = function(){
    const numWeeks = 2;
    const now = new Date();
    now.setDate(now.getDate() + numWeeks * 7 + 1);
    $('.date').calendar({
      type: 'date',
      initialDate: new Date(),
      minDate: now,
      text: {
      },
    });
  }
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
  $(document).on('click', '.approve.button', function(event) {
    id = $(this).data('id');
    event.preventDefault();
    loadModal({
        'url' : '{{ url($pageUrl) }}/aprove-modal/'+id,
        'modal' : '.{{ $modalSize }}.modal',
        'formId' : '#dataForm',
        'onShow' : function(){
            onShow();
        },
        'onApprove' : function(){
          modal = '.{{ $modalSize }}.modal';
          $(modal).find('.loading.dimmer').addClass('active');
          duedate = $('#duedate').val();
          if(duedate === ''){
            index = 'due_date';
            val = ['Cannot be empty'];
            clearFormError(index,val);
            showFormError(index,val);

            time = 5;
            interval = setInterval(function(){
              time--;
              if(time == 0){
                clearInterval(interval);
                $('.pointing.prompt.label.transition.visible').fadeOut('slideUp', function(e) {
                  $(this).remove();
                });
                $('.error').each(function (index, val) {
                  $(val).removeClass('error');
                });
              }
            },1000);
          }else{
            $.ajax({
              url: '{{ url($pageUrl) }}/aprove-modal',
              type: "POST",
              data: $('#dataForm').serialize(),
              success: function(response){
                swal({
                  title: 'Successfully',
                  text: " ",
                  type: 'success',
                  allowOutsideClick: false
                }).then((result) => {
                  $(modal).modal('hide');
                  location.href = '{{ url($pageUrl) }}';
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
          $(modal).find('.loading.dimmer').removeClass('active');
        }
    })
  });
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
</script>
@endsection

@section('content-body')
<form id="dataForm" action="{{ url($pageUrl.$record->id) }}" class="ui form" method="POST">
  <div class="ui form">
    {!! csrf_field() !!}
    <input type="hidden" name="id" value="{{ $record->id }}">
    @if ($record->last_date)
      <input type="hidden" name="type" value="duplicate">
    @else
      <input type="hidden" name="type" value="review">
    @endif
    <input type="hidden" name="_method" value="PUT">
    <div class="ui segment">
      <div class="three fields">
        <div class="field">
          <label>Site</label>
          <input type="text" name="name" placeholder="Contractor Name" value="{{ $record->site->name }}" readonly>
        </div>
          <div class="field">
            <label>Company</label>
            <input type="text" name="company" placeholder="Company" value="{{ $record->company }}" readonly>
          </div>
          <div class="field">
            <label>Department</label>
            <input type="text" name="department" placeholder="Department" value="{{ $record->department }}" readonly>
          </div>
      </div>
      
      <div class="three fields">
        <div class="field">
            <label>Employee Name</label>
            <input type="text" name="name" placeholder="Contractor Name" value="{{ $record->employee->display }}" readonly>
        </div>
        <div class="field">
            <label>Employee ID</label>
            <input type="text" name="employee_id" value="{{ $record->employee_id }}" readonly placeholder="Employee ID">
        </div>
        <div class="field">
            <label>Job Position</label>
            <input type="text" name="title" value="{{ $record->title }}" readonly placeholder="Job Position">
        </div>
      </div>
      
      <div class="three fields">
        <div class="field">
            <label>Sex / Gender</label>
            <input type="text" name="name" placeholder="Contractor Name" value="{{ $record->gender }}" readonly>
        </div>
        <div class="field">
            <label>Blood</label>
            <input type="text" name="name" placeholder="Contractor Name" value="{{ $record->blood->name }}" readonly>
        </div>
        <div class="field">
            <label>Date of Birth</label>
            <input type="text" name="date_birth" placeholder="Date of Birth" readonly="" value="{{ Helpers::DateParse($record->date_birth) }}">
        </div>
      </div>
      @if ($record->last_date)
        <div class="ui horizontal divider">
          Result MCU
        </div>
        <div class="three fields">
          <div class="field">
            <label>MCU Provider</label>
            <input type="text" name="provider" placeholder="MCU Provider" value="{{ $record->provider }}">
          </div>
          <div class="field">
            <label>MCU Type</label>
            <select class="ui fluid search dropdown" name="type_id">
              {!! App\Models\Master\TypeMcu::options('name','id',['selected' => $record->type_id], 'Choose One') !!}
            </select>
          </div>
          <div class="field">
            <label>Attachment {!! $record->primaryFiles ? '<a href="'.asset('storage/'.$record->primaryFiles->url).'" target="_blank">(Download File Existing)</a>':'' !!}</label>
            <div class="ui fluid file input action">
              <input type="text" id="lampiran-first-text" readonly>
              <input type="file" class="six wide column" id="lampiran-first" name="foto" accept="application/pdf,image/*" autocomplete="off">
              <div class="ui button file">
                Browse...
              </div>
            </div>
          </div>
        </div>
        <div class="three fields">
          <div class="field">
              <label>Result</label>
              <select class="ui fluid search dropdown" id="result_id" name="result_id">
                {!! App\Models\Master\Result::options('name','id',[], 'Choose One') !!}
              </select>
          </div>
          <div class="field dateArive">
              <label>Last date of Examination </label>
              <input type="text" name="last_date" id="last_date" placeholder="Last date of Examination " readonly="">
          </div>
          <div class="field dateExit">
              <label>Due date </label>
              <input type="text" name="due_date" id="due_date" placeholder="Due date " readonly="">
          </div>
        </div>
        <div class="field">
          <label>Reason Result <b>(Optional)</b></label>
          <textarea name="reason_result" id="reason_result" rows="5"></textarea>
        </div>
      @else
        <div class="three fields">
          <div class="field">
              <label>MCU Provider</label>
              <input type="text" name="provider" value="{{ $record->provider }}" readonly placeholder="MCU Provider">
          </div>
          <div class="field">
            <label>MCU Type</label>
            <input type="text" name="name" placeholder="Contractor Name" value="{{ $record->type->name }}" readonly>
          </div>
          <div class="field" id="userAssign">
              <label>Assign Propose MCU to</label>
              <input type="text" readonly name="mail_employee" value="{{ $record->mail->user ? $record->mail->user->email:'' }}" placeholder="user@mail.com">
          </div>
        </div>
        <div class="field">
          <label>Attachment</label>
          <div class="ui fluid file input action">
            <input type="text" id="lampiran-first-text" value="{{ $record->primaryFiles->filename }}" readonly>
            @if ($record->primaryFiles)
              <a href="{{ asset('storage/'.$record->primaryFiles->url) }}" target="_blank">
                <div class="ui button file">
                  Download
                </div>
              </a>
            @else
              <div class="ui button file disabled">
                Download
              </div>
            @endif
          </div>
        </div>
        <div class="ui horizontal divider">
          Result MCU
        </div>
        <div class="three fields">
          <div class="field">
              <label>Result</label>
              <select class="ui fluid search dropdown" id="result_id" name="result_id">
                {!! App\Models\Master\Result::options('name','id',[], 'Choose One') !!}
              </select>
          </div>
          <div class="field dateArive">
              <label>Last date of Examination </label>
              <input type="text" name="last_date" id="last_date" placeholder="Last date of Examination " readonly="">
          </div>
          <div class="field dateExit">
              <label>Due date </label>
              <input type="text" name="due_date" id="due_date" placeholder="Due date " readonly="">
          </div>
        </div>
        <div class="field">
          <label>Reason Result <b>(Optional)</b></label>
          <textarea name="reason_result" id="reason_result" rows="5"></textarea>
        </div>
      @endif
      <div class="ui two column grid">
        <div class="left aligned column">
          <a class="ui labeled icon button" href="{{ url($pageUrl) }}">
            <i class="chevron left icon"></i>
            Back
          </a>
        </div>
        <div class="right aligned column">
          <div class="ui positive right labeled icon save as page button">
            Submit
            <i class="checkmark icon"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
