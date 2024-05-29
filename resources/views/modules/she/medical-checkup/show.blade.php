@extends('layouts.form')

@section('styles')

@endsection

@section('scripts')
<script type="text/javascript">
  initModal = function(){
    // const numWeeks = 2;
    // const now = new Date();
    // now.setDate(now.getDate() + numWeeks * 7 + 1);
    $('.date').calendar({
      type: 'date',
      initialDate: new Date(),
      minDate: new Date(),
      text: {
      },
    });
  }
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
          loc = $('#location').val();
          if((duedate === '' ) || (loc === '')){
            $(modal).find('.loading.dimmer').removeClass('active');
            index = 'appointment_date';
            val = ['Cannot be empty'];
            clearFormError(index,val);
            showFormError(index,val);

            index2 = 'appointment_location';
            val = ['Cannot be empty'];
            clearFormError(index2,val);
            showFormError(index2,val);

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
                $('.error').each(function (index2, val) {
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
                $(modal).find('.loading.dimmer').removeClass('active');
                swal({
                  title: 'Successfully',
                  text: " ",
                  type: 'success',
                  allowOutsideClick: false
                }).then((result) => {
                  $(modal).modal('hide');
                  location.reload();
                  return true;
                })
              },
              error : function(resp){
                $(modal).find('.loading.dimmer').removeClass('active');
                var mes = 'Data not found.';
                swal(
										'Failed Action!',
										mes,
										'error'
									);
              },
            });
          }
        }
    })
  });
</script>
@endsection

@section('content-body')
<div class="ui form">
    <div class="ui segment">
      <div class="ui top attached tabular menu">
        <a class="item active" data-tab="1">Form</a>
        <a class="item" data-tab="2">History</a>
      </div>
      <div class="ui bottom attached tab segment active" data-tab="1">
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
            <input type="text" name="name" placeholder="Contractor Name" value="{{ $record->result ? $record->result->name:'' }}" readonly>
          </div>
          <div class="field">
            <label>Last date of Examination </label>
            <input type="text" name="last_date" placeholder="Last date of Examination " readonly="" value="{{ Helpers::DateParse($record->last_date) }}">
          </div>
          <div class="field dateExit">
            <label>Due date </label>
            <input type="text" name="due_date" placeholder="Due date" {!! $due_date ? 'style="color: red;"':'' !!} readonly="" value="{{ Helpers::DateParse($record->due_date) }}">
          </div>
        </div>
        <div class="field">
          <label>Reason Result <b>(Optional)</b></label>
          <textarea name="reason_result" id="reason_result" readonly rows="5">{{ $record->reason_result }}</textarea>
        </div>
        @if ($record->appointment_date)
          <div class="ui horizontal divider">
            Appointment Schedule MCU
          </div>
          <div class="two fields">
            <div class="field">
              <label>Appointment Date </label>
              <input type="text" name="last_date" placeholder="Appointment Date " readonly="" value="{{ Helpers::DateParse($record->appointment_date) }}">
            </div>
            <div class="field">
              <label>Location Appointment</label>
              <input type="text" name="name" placeholder="Location Appointment" value="{{ $record->appointment_location }}" readonly>
            </div>
          </div>
        @endif
      </div>
      <div class="ui bottom attached tab segment" data-tab="2">
        @if ($record->history->count() > 0)
            <table class="ui celled table">
              <thead>
                <tr class="text-center">
                  <th width="25%">Information Employee</th>
                  <th width="12%">MCU Provider</th>
                  <th width="12%">MCU Type</th>
                  <th width="12%">Assign Propose MCU to</th>
                  <th width="5%">Attachment</th>
                  <th width="">Result MCU</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($record->history as $item)
                  <tr>
                    <td>
                      <b>Employee Name : </b>{{ $item->employee->display }}<br>
                      <b>Employee ID : </b>{{ $item->employee_id }}<br>
                      <b>Company : </b>{{ $item->company }}<br>
                      <b>Department : </b>{{ $item->department }}<br>
                      <b>Job Position : </b>{{ $item->title }}<br>
                      <b>Date of Birth/ Age / Blood : </b>{{ Helpers::DateParse($item->date_birth) }} / {{ $item->ageConvert() }} yo  / {{ $item->blood->name }}<br>
                      <b>Company : </b>{{ $item->company }}
                    </td>
                    <td>{{ $item->provider }}</td>
                    <td>{{ $item->type->name }}</td>
                    <td>{{ $item->mail->user ? $item->mail->user->email:'' }}</td>
                    <td>
                      @if ($item->primaryFiles)
                        <a href="{{ asset('storage/'.$item->primaryFiles->url) }}" target="_blank">
                          <div class="ui button file">
                            Download
                          </div>
                        </a>
                      @else
                        <div class="ui button file disabled">
                          Download
                        </div>
                      @endif
                    </td>
                    <td>
                      <b>Result : </b>{{ $record->result ? $record->result->name:'' }}<br>
                      <b>Last date of Examination : </b>{{ Helpers::DateParse($record->last_date) }}<br>
                      <b>Due date : </b>{{ Helpers::DateParse($record->due_date) }}<br>
                      <b>Reason Result  : </b>{{ $record->reason_result }}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
        @else
          <div class="ui icon message">
            <i class="ban icon"></i>
            <div class="content">
              <div class="header">
                History not found.
              </div>
              <p>No history has occurred, if there is history it will be displayed here.</p>
            </div>
          </div>
        @endif
      </div>
      <br>
      <div class="ui two column grid">
        <div class="left aligned column">
          <a class="ui labeled icon button" href="{{ url($pageUrl) }}">
            <i class="chevron left icon"></i>
            Back
          </a>
        </div>
        @if ($approved)
          <div class="right aligned column">
            <a class="ui positive right labeled icon approve button" data-id="{{ $record->id }}" href="#">
              Set Appointment
              <i class="calendar icon"></i>
            </a>
          </div>
        @endif
      </div>
    </div>
</div>
@endsection
