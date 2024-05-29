@extends('layouts.form')

@section('styles')

@endsection

@section('scripts')
<script type="text/javascript">
  $('.maxdate').calendar({
      type: 'date',
      initialDate: new Date(),
      maxDate: new Date(),
      text: {
      },
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
          <label>Company</label>
          <input type="text" name="name" placeholder="Contractor Name" value="{{ $record->site->name }}" readonly>
        </div>
        <div class="field">
          <label>Training Type</label>
          <input type="text" name="name" placeholder="Contractor Name" value="{{ $record->type->name }}" readonly>
        </div>
        <div class="field">
          <label>Certificate Number</label>
          <input type="text" name="number" placeholder="Certificate Number" readonly value="{{ $record->number }}">
        </div>
      </div>
      <div class="three fields">
        <div class="field">
          <label>Title Training</label>
          <input type="text" name="number" placeholder="Title Training" readonly value="{{ $record->title }}">
        </div>
        <div class="field">
          <label>Department</label>
          <input type="text" name="number" placeholder="Department" readonly value="{{ $record->department }}">
        </div>
        <div class="field">
          <label>Employee Name</label>
          <input type="text" name="number" placeholder="Employee Name" readonly value="{{ $record->employee_name }}">
        </div>
      </div>
      <div class="three fields">
        <div class="field">
          <label>Date of Training </label>
          <input type="text" name="training_date" placeholder="Date of Training " readonly="" value="{{ Helpers::DateParse($record->training_date) }}">
        </div>
        <div class="field">
          <label>Expired Date</label>
          <input type="text" name="expire_date" placeholder="Expired Date" readonly="" value="{{ Helpers::DateParse($record->expire_date) }}">
        </div>
        <div class="field">
          <label>Issued by</label>
          <input type="text" name="name" placeholder="Issued by" value="{{ $record->employee->name or '' }}" readonly>
        </div>
      </div>
      <table class="ui celled structured table">
        <tbody>
            <tr>
                <td class="center aligned field">
                    <label><u>Material File</u></label>
                    <div class="ui centered cards">
                        {!! $record->showCardFile('detail') !!}
                    </div>
                    <div id="showFileExistDelete"></div>
                </td>
            </tr>
        </tbody>
      </table>
      <div class="ui two column grid">
        <div class="left aligned column">
          <a class="ui labeled icon button" href="{{ url($pageUrl) }}">
            <i class="chevron left icon"></i>
            Back
          </a>
        </div>
        <div class="right aligned column">
          {{-- <div class="ui positive right labeled icon save as page button">
            Save
            <i class="checkmark icon"></i>
          </div> --}}
        </div>
      </div>
    </div>

</div>

</form>
@endsection
