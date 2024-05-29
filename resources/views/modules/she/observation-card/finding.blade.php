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
        if(this.files[0].size < 5933862){

        }else{
          swal({
              title: "Size doesn't fit",
              text: "Max Size File 5MB",
              type: 'error',
              allowOutsideClick: false
          }).then((res) => {
            $('#lampiran-first-text').val('');
            $(this).val('');
          })
        }
      }
    });
    
    $(document).on('change', '#lampiran-sec', function(e){
      var fileExtension = ['png','jpg','jpeg','pdf'];
      if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1){
        swal({
            title: 'Incorrect format',
            text: "Files must be in the form of images and pdf",
            type: 'error',
            allowOutsideClick: false
        }).then((res) => {
          $('#lampiran-sec-text').val('');
          $(this).val('');
        })
      }else{
        if(this.files[0].size < 5933862){

        }else{
          swal({
              title: "Size doesn't fit",
              text: "Max Size File 5MB",
              type: 'error',
              allowOutsideClick: false
          }).then((res) => {
            $('#lampiran-sec-text').val('');
            $(this).val('');
          })
        }
      }
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
    <input type="hidden" name="slug" value="insert-finding">
    <input type="hidden" name="type" value="{{ $record->type }}">

    <div class="ui segment">
      <div class="three fields">
        <div class="field">
          <label>Company</label>
          <input type="text" readonly value="{{ $record->site->name or '' }}" placeholder="Observed Company">
        </div>
        <div class="field">
          <label>Location / Lokasi temuan</label>
          <input type="text" readonly value="{{ $record->locations->name or '' }}" placeholder="Location">
        </div>
        <div class="field">
          <label>Location Details / Detail lokasi</label>
          <input type="text" readonly name="location_detail" value="{{ $record->location_detail or '' }}" placeholder="Location Details">
        </div>
      </div>

      <div class="three fields">
        <div class="field">
          <label>Observed Company Details</label>
          <input type="text" readonly name="company" value="{{ $record->company or '' }}" placeholder="Observed Company">
        </div>
        <div class="field">
          <label>Department's Name / Departmen Pengamat</label>
          <input type="text" readonly value="{{ $record->department->name or '' }}" placeholder="Observer's Name">
        </div>
        <div class="field">
          <label>Observer's Name / Nama Pengamat</label>
          <input type="text" readonly name="observer_name" value="{{ $record->observer_name or '' }}" placeholder="Observer's Name">
        </div>
      </div>

      <div class="four fields">
        <div class="field maxdate">
          <label>Observed Date / Tanggal observasi</label>
          <input type="text" name="date" value="{{ $record->date or '' }}" placeholder="Observed Date" readonly="">
        </div>
        <div class="field">
          <label>PIC Department / Departmen PIC</label>
          <input type="text" readonly value="{{ $record->pic->name or '' }}" placeholder="Observer's Name">
        </div>
        <div class="field">
          <label>Finding / Temuan Mengenai ?</label>
          <div class="fields">
            <div class="ui radio checkbox">
              <input type="radio" name="finding" {{ $record->finding == 1 ? 'checked':'' }} value="1">
              <label>Unsafe Action</label>
            </div>
          </div>
          <div class="fields">
            <div class="ui radio checkbox">
              <input type="radio" name="finding" {{ $record->finding == 2 ? 'checked':'' }} value="2" >
              <label>Unsafe Condition</label>
            </div>
          </div>
          <div class="fields">
            <div class="ui radio checkbox">
              <input type="radio" name="finding" {{ $record->finding == 3 ? 'checked':'' }} value="3" >
              <label>Positive Observation</label>
            </div>
          </div>
        </div>
        <div class="field">
          <label>Status Finding ?</label>
          <div class="fields">
            <div class="ui radio checkbox">
              <input type="radio" name="status" {{ $record->status == 1 ? 'checked':'' }} value="1">
              <label>OPEN</label>
            </div>
          </div>
          <div class="fields">
            <div class="ui radio checkbox">
              <input type="radio" name="status" {{ $record->status == 2 ? 'checked':'' }} value="2" >
              <label>CLOSED</label>
            </div>
          </div>
          <div class="fields">
            <div class="ui radio checkbox">
              <input type="radio" name="status" {{ $record->status == 3 ? 'checked':'' }} value="3" >
              <label>Positive Finding</label>
            </div>
          </div>
        </div>
      </div>

      <h5 class="ui dividing header">Complete All Applicable Sections / Lengkapi Semua Bagian yang Berlaku</h5>
      @forelse (App\Models\Master\ObservationCategory::get() as $key => $item)
          @if ($key % 2 == 0)
            <div class="two fields">
          @else
              
          @endif
          <div class="field">
            <label>{{ $item->name }}</label>
            <table>
              <tbody>
                @foreach ($item->component as $key2 => $component)
                    <tr>
                      <td width="70%">{{$key2 + 1 }}. {{ $component->desc }}</td>
                      <td>
                        <div class="ui checkbox">
                          <input type="radio" name="category_id[{{ $component->id }}]" {{ $record->category()->where('category_id',$component->id)->where('nilai',1)->count() > 0 ? 'checked':'' }} value="1">
                          <label>Safe / Aman</label>
                        </div>
                      </td>
                      <td>
                        <div class="ui checkbox">
                          <input type="radio" name="category_id[{{ $component->id }}]" {{ $record->category()->where('category_id',$component->id)->where('nilai',2)->count() > 0 ? 'checked':'' }} value="2">
                          <label>At Risk / Beresiko</label>
                        </div>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @if ($key % 2 == 0)
            @if($loop->last)
              </div>
            @endif
          @else
            </div>
          @endif
        @empty
          <div class="field">
            <div class="ui radio checkbox">
              <input type="radio" disabled name="" value="1">
              <label>Data Not Found</label>
            </div>
          </div>
        @endforelse

      <h5 class="ui dividing header">Complete All Applicable Sections / Lengkapi Semua Bagian yang Berlaku</h5>
      <div class="three fields">
        <div class="field">
          <label>Action or Conditions Observed / Tindakan atau Kondisi yang Diamati</label>
          <textarea rows="2" name="action" placeholder="Action or Conditions Observed / Tindakan atau Kondisi yang Diamati">{{ $record->action or '' }}</textarea>
        </div>
        <div class="field">
          <label>Note For Positive Observation / Catatan untuk Pengamatan Positif ?</label>
          <textarea rows="2" name="note" placeholder="Note For Positive Observation / Catatan untuk Pengamatan Positif ?">{{ $record->note or '' }}</textarea>
        </div>
        <div class="field">
          <label>Immediate Corrective Action / Tindakan Korektif ?</label>
          <textarea rows="2" name="corrective" placeholder="Immediate Corrective Action / Tindakan Korektif ?">{{ $record->corrective or '' }}</textarea>
        </div>
      </div>
      <div class="three fields">
        <div class="field">
          <label>Follow-Up of Action & Close-Out / Tindak Lanjut ?</label>
          <textarea rows="2" name="follow_up" placeholder="Follow-Up of Action & Close-Out / Tindak Lanjut ?">{{ $record->follow_up or '' }}</textarea>
        </div>
        <div class="field">
          <label>Energy Sources (Sumber Energy) ?</label>
          <select id="sources" name="sources" class="ui class dropdown">
              {!! App\Models\Master\EnergySources::options('name','id',[
                'selected' => $record->sources,
              ], 'Choose One') !!}
          </select>
        </div>
        <div class="field">
          <label>Additional Comments / Komentar Tambahan ?</label>
          <textarea rows="2" name="comments" placeholder="Additional Comments / Komentar Tambahan ?">{{ $record->comments or '' }}</textarea>
        </div>
      </div>
      <div class="two fields">
        <div class="field">
          <label>Photograph / Foto {!! $record->primaryFiles ? '<a href="'.asset('storage/'.$record->primaryFiles->url).'" target="_blank">(Download File)</a>':'' !!}</label>
          <div class="ui fluid file input action">
		        <input type="text" id="lampiran-first-text" value="{{ $record->primaryFiles->filename }}" readonly>
		        <input type="file" class="six wide column" id="lampiran-first" name="foto" accept="application/pdf,image/*" autocomplete="off">
		        <div class="ui button file">
		          Browse...
		        </div>
		      </div>
        </div>
        <div class="field">
          <label>Photograph for closing finding / Foto untuk tindak lanjut temuan {!! $record->secFiles ? '<a href="'.asset('storage/'.$record->secFiles->url).'" target="_blank">(Download File)</a>':'' !!}</label>
          <div class="ui fluid file input action">
		        <input type="text" id="lampiran-sec-text" {!! $record->secFiles ? 'value="'.$record->secFiles->filename.'"':'' !!} readonly>
		        <input type="file" class="six wide column" id="lampiran-sec" name="other_foto" accept="application/pdf,image/*" autocomplete="off">
		        <div class="ui button file">
		          Browse...
		        </div>
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
