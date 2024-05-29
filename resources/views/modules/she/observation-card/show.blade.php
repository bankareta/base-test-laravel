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

    $(document).on('click', '.save.as.pic', function(event) {
      id = $(this).data('id');
      status = $(this).data('status');
      tlt = "Approve Data";
      txt = "Is the data that you want to Approve is appropriate??";
      if(status === 'reject'){
        tlt = "Reject Data";
        txt = "Is the data that you want to Reject is appropriate??";
      }
      swal({
        title: tlt,
        text: txt,
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        reverseButtons: true,
        cancelButtonText: 'Cancel'
        }).then((result) => {
          $('#cover').css('display','');
          $.ajax({
            url: '{{ url($pageUrl) }}/action-pic',
            type: "POST",
            data : {
              "_token":'{{ csrf_token() }}',
              'id':id,
              'status':status,
            },
            success: function(response){
              $('#cover').css('display','none');
              swal({
                title: 'Successfully',
                text: " ",
                type: 'success',
                allowOutsideClick: false
              }).then((result) => {
                location.href = '{{ url($pageUrl) }}';
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
          <input type="text" readonly name="company" value="{{ $record->site->name or '' }}" placeholder="Observed Company">
        </div>
        <div class="field">
          <label>Location / Lokasi temuan</label>
          <input type="text" readonly name="location" value="{{ $record->locations->name or '' }}" placeholder="Location">
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
          <input type="text" readonly name="observer_name" value="{{ $record->department->name or '' }}" placeholder="Observer's Name">
        </div>
        <div class="field">
          <label>Observer's Name / Nama Pengamat</label>
          <input type="text" readonly name="observer_name" value="{{ $record->observer_name or '' }}" placeholder="Observer's Name">
        </div>
      </div>
      <div class="four fields">
        <div class="field">
          <label>Observed Date / Tanggal observasi</label>
          <input type="text" name="date" value="{{ Helpers::DateParse($record->date) }}" placeholder="Observed Date" readonly="">
        </div>
        <div class="field">
          <label>PIC Department / Departmen PIC</label>
          <input type="text" readonly name="observer_name" value="{{ $record->pic->name or '' }}" placeholder="Observer's Name">
        </div>
        <div class="field">
          <label>Finding / Temuan Mengenai ?</label>
          <div class="fields">
            <div class="ui radio checkbox">
              <input type="radio" disabled name="finding" {{ $record->finding == 1 ? 'checked':'' }} value="1">
              <label>Unsafe Action</label>
            </div>
          </div>
          <div class="fields">
            <div class="ui radio checkbox">
              <input type="radio" disabled name="finding" {{ $record->finding == 2 ? 'checked':'' }} value="2" >
              <label>Unsafe Condition</label>
            </div>
          </div>
          <div class="fields">
            <div class="ui radio checkbox">
              <input type="radio" disabled name="finding" {{ $record->finding == 3 ? 'checked':'' }} value="3" >
              <label>Positive Observation</label>
            </div>
          </div>
        </div>
        <div class="field">
          <label>Status Finding ?</label>
          <div class="fields">
            <div class="ui radio checkbox">
              <input type="radio" disabled name="status" {{ $record->status == 1 ? 'checked':'' }} value="1">
              <label>OPEN</label>
            </div>
          </div>
          <div class="fields">
            <div class="ui radio checkbox">
              <input type="radio" disabled name="status" {{ $record->status == 2 ? 'checked':'' }} value="2" >
              <label>CLOSED</label>
            </div>
          </div>
          <div class="fields">
            <div class="ui radio checkbox">
              <input type="radio" disabled name="status" {{ $record->status == 3 ? 'checked':'' }} value="3" >
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
                          <input type="radio" disabled name="category_id[{{ $component->id }}]" {{ $record->category()->where('category_id',$component->id)->where('nilai',1)->count() > 0 ? 'checked':'' }} value="1">
                          <label>Safe / Aman</label>
                        </div>
                      </td>
                      <td>
                        <div class="ui checkbox">
                          <input type="radio" disabled name="category_id[{{ $component->id }}]" {{ $record->category()->where('category_id',$component->id)->where('nilai',2)->count() > 0 ? 'checked':'' }} value="2">
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
          <textarea rows="2" readonly name="action" placeholder="Action or Conditions Observed / Tindakan atau Kondisi yang Diamati">{{ $record->action or '' }}</textarea>
        </div>
        <div class="field">
          <label>Note For Positive Observation / Catatan untuk Pengamatan Positif ?</label>
          <textarea rows="2" readonly name="note" placeholder="Note For Positive Observation / Catatan untuk Pengamatan Positif ?">{{ $record->note or '' }}</textarea>
        </div>
        <div class="field">
          <label>Immediate Corrective Action / Tindakan Korektif ?</label>
          <textarea rows="2" readonly name="corrective" placeholder="Immediate Corrective Action / Tindakan Korektif ?">{{ $record->corrective or '' }}</textarea>
        </div>
      </div>
      <div class="three fields">
        <div class="field">
          <label>Follow-Up of Action & Close-Out / Tindak Lanjut ?</label>
          <textarea rows="2" readonly name="follow_up" placeholder="Follow-Up of Action & Close-Out / Tindak Lanjut ?">{{ $record->follow_up or '' }}</textarea>
        </div>
        <div class="field">
          <label>Energy Sources (Sumber Energy) ?</label>
          <textarea rows="2" readonly name="sources" placeholder="Energy Sources (Sumber Energy) ?">{{ $record->energySources->name or '' }}</textarea>
        </div>
        <div class="field">
          <label>Additional Comments / Komentar Tambahan ?</label>
          <textarea rows="2" readonly name="comments" placeholder="Additional Comments / Komentar Tambahan ?">{{ $record->comments or '' }}</textarea>
        </div>
      </div>
      <div class="two fields">
        <div class="field">
          <label>Photograph / Foto</label>
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
        <div class="field">
          <label>Photograph for closing finding / Foto untuk tindak lanjut temuan</label>
          <div class="ui fluid file input action">
		        <input type="text" id="lampiran-sec-text" {!! $record->secFiles ? 'value="'.$record->secFiles->filename.'"':'' !!} readonly>
		        @if ($record->secFiles)
              <a href="{{ asset('storage/'.$record->secFiles->url) }}" target="_blank">
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
      </div>
      <br>
      <div class="ui two column grid">
        <div class="left aligned column">
          <a class="ui labeled icon button" href="{{ url($pageUrl) }}">
            <i class="chevron left icon"></i>
            Back
          </a>
        </div>
        <div class="right aligned column">
          @if ($record->type == 1)
              @if ($record->pic->person->id == auth()->user()->id)
                <div class="ui buttons">
                    <button type="button" data-id="{{ $record->id }}" data-status="reject" class="ui red button save as pic">Reject</button>
                    <div class="or"></div>
                    <button type="button" data-id="{{ $record->id }}" data-status="approve" class="ui positive button save as pic">Approve</button>
                </div>
              @endif
          @endif
        </div>
      </div>
    </div>

</div>

</form>
@endsection
