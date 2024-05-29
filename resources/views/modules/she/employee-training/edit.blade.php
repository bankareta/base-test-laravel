@extends('layouts.form')

@section('styles')
<style type="text/css">
  .ui.inverted.progress{
    margin: 0 0 0 0 !important;
    height: 25px;
  }
  .ui.inverted.progress > .bar{
    height: 25px;
  }
  #labelInfo{
    padding: 7px;
  }
  td {
    overflow: visible !important;
  }
</style>
@endsection

@section('scripts')
@include('modules.she.employee-training.script')
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
          <label>Training Type</label>
          <select class="ui fluid search dropdown" name="type_id">
            {!! App\Models\Master\TypeTraining::options('name','id',['selected' => $record->type_id], 'Choose One') !!}
          </select>
        </div>
        <div class="field">
          <label>Certificate Number</label>
          <input type="text" name="number" placeholder="Certificate Number" value="{{ $record->number }}">
        </div>
      </div>
      <div class="three fields">
        <div class="field">
          <label>Title Training</label>
          <input type="text" name="title" placeholder="Title Training" value="{{ $record->title }}">
        </div>
        <div class="field">
          <label>Department</label>
          <input type="text" name="department" placeholder="Department" value="{{ $record->department }}">
        </div>
        <div class="field">
          <label>Employee Name</label>
          <input type="text" name="employee_name" placeholder="Employee Name" value="{{ $record->employee_name }}">
        </div>
      </div>
      <div class="three fields">
        <div class="field maxdate">
          <label>Date of Training </label>
          <input type="text" name="training_date" placeholder="Date of Training " readonly="" value="{{ $record->training_date }}">
        </div>
        <div class="field date">
          <label>Expired Date</label>
          <input type="text" name="expire_date" placeholder="Expired Date" readonly="" value="{{ $record->expire_date }}">
        </div>
        <div class="field">
          <label>Issued by</label>
          <select id="employee" name="issued_by" class="ui fluid search dropdown">
            {!! App\Models\Master\InstitutionTraining::options('name','id',['selected' => $record->issued_by], 'Choose One') !!}
          </select>
        </div>
      </div>
      <table class="ui celled structured table">
        <tbody>
            <tr>
                <td class="center aligned field">
                    <label><u>Material File</u></label>
                    <div class="ui centered cards">
                        <div class="small card">
                            <input type="file" class="hidden mfs multiple file-custom input" name="picture[]" accept="application/pdf,image/*" data-url="{{ url($pageUrl.'sertifikat-upload/') }}" multiple>
                            <div class="blurring dimmable image">
                            <div class="ui dimmer">
                                <div class="content">
                                <div class="center">
                                    <div class="ui blue icon large mfs multiple-custom upload button"><i class="cloud upload icon"></i></div>
                                </div>
                                </div>
                            </div>
                            <img src="{{ asset('img/upload-image.png') }}">
                            </div>
                        </div>
                        {!! $record->showCardFile() !!}
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
