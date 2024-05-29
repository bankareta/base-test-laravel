@extends('layouts.form')

@section('styles')
<style type="text/css">
</style>
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
      
      $(document).on('change', '.companyChoise', function(e){
        $('#location').dropdown('clear');
        $('#departObserver').dropdown('clear');
        $('#picDepart').dropdown('clear');
        var val = $('.companyChoise option:selected').val();
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
              $('#location').html(resp.data);
              $('#location').dropdown();
              $('#location').dropdown('refresh');
              
              $('#departObserver').html(resp.depart);
              $('#departObserver').dropdown();
              $('#departObserver').dropdown('refresh');
              
              $('#picDepart').html(resp.depart);
              $('#picDepart').dropdown();
              $('#picDepart').dropdown('refresh');
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
          <label>Company</label>
          <select id="site_id" name="site_id" class="ui class dropdown companyChoise">
              {!! App\Models\Master\Site::options('name','id',['filters' => [
                function ($site) {
                    $site->whereIn('id', auth()->user()->site->pluck('id')->toArray());
                  },
                ]
              ], 'Choose One') !!}
          </select>
        </div>
        <div class="field">
          <label>Location / Lokasi temuan</label>
          <select id="location" name="location" class="ui class dropdown showLocation">
            
          </select>
        </div>
        <div class="field">
          <label>Location Details / Detail lokasi</label>
          <input type="text" name="location_detail" placeholder="Location Details">
        </div>
      </div>
      <div class="three fields">
        <div class="field">
          <label>Observed Company Details</label>
          <input type="text" name="company" placeholder="Observed Company">
        </div>
        <div class="field">
          <label>Observer's Department / Departemen Pengamat</label>
          <select id="departObserver" name="obs_department_id" class="ui class dropdown">

          </select>
        </div>
        <div class="field">
          <label>Observer's Name / Nama Pengamat</label>
          <input type="text" name="observer_name" placeholder="Observer's Name">
        </div>
      </div>

      <div class="four fields">
        <div class="field maxdate">
          <label>Observed Date / Tanggal observasi</label>
          <input type="text" name="date" placeholder="Observed Date" readonly="">
        </div>
        <div class="field">
          <label>PIC Department / Departemen PIC</label>
          <select id="picDepart" name="department_id" class="ui class dropdown">

          </select>
        </div>
        <div class="field">
          <label>Finding / Temuan Mengenai ?</label>
          <div class="fields">
            <div class="ui radio checkbox">
              <input type="radio" name="finding" value="1">
              <label>Unsafe Action</label>
            </div>
          </div>
          <div class="fields">
            <div class="ui radio checkbox">
              <input type="radio" name="finding" value="2" >
              <label>Unsafe Condition</label>
            </div>
          </div>
          <div class="fields">
            <div class="ui radio checkbox">
              <input type="radio" name="finding" value="3" >
              <label>Positive Observation</label>
            </div>
          </div>
        </div>
        <div class="field">
          <label>Status Finding ?</label>
          <div class="fields">
            <div class="ui radio checkbox">
              <input type="radio" name="status" value="1">
              <label>OPEN</label>
            </div>
          </div>
          <div class="fields">
            <div class="ui radio checkbox">
              <input type="radio" name="status" value="2" >
              <label>CLOSED</label>
            </div>
          </div>
          <div class="fields">
            <div class="ui radio checkbox">
              <input type="radio" name="status" value="3" >
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
                          <input type="radio" name="category_id[{{ $component->id }}]" value="1">
                          <label>Safe / Aman</label>
                        </div>
                      </td>
                      <td>
                        <div class="ui checkbox">
                          <input type="radio" name="category_id[{{ $component->id }}]" value="2">
                          <label>At Risk / Beresiko</label>
                        </div>
                      </td>
                    </tr>
                    {{-- <div class="ui radio checkbox">
                      <input type="radio" name="category_id[{{$key}}]" value="{{ $component->id }}">
                    </div> --}}
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
          <textarea rows="2" name="action" placeholder="Action or Conditions Observed / Tindakan atau Kondisi yang Diamati"></textarea>
        </div>
        <div class="field">
          <label>Note For Positive Observation / Catatan untuk Pengamatan Positif ?</label>
          <textarea rows="2" name="note" placeholder="Note For Positive Observation / Catatan untuk Pengamatan Positif ?"></textarea>
        </div>
        <div class="field">
          <label>Immediate Corrective Action / Tindakan Korektif ?</label>
          <textarea rows="2" name="corrective" placeholder="Immediate Corrective Action / Tindakan Korektif ?"></textarea>
        </div>
      </div>
      <div class="three fields">
        <div class="field">
          <label>Follow-Up of Action & Close-Out / Tindak Lanjut ?</label>
          <textarea rows="2" name="follow_up" placeholder="Follow-Up of Action & Close-Out / Tindak Lanjut ?"></textarea>
        </div>
        <div class="field">
          <label>Energy Sources (Sumber Energy) ?</label>
          <select id="sources" name="sources" class="ui class dropdown">
            {!! App\Models\Master\EnergySources::options('name','id',[], 'Choose One') !!}
          </select>
        </div>
        <div class="field">
          <label>Additional Comments / Komentar Tambahan ?</label>
          <textarea rows="2" name="comments" placeholder="Additional Comments / Komentar Tambahan ?"></textarea>
        </div>
      </div>
      <div class="two fields">
        <div class="field">
          <label>Photograph / Foto </label>
          <div class="ui fluid file input action">
		        <input type="text" id="lampiran-first-text" readonly>
		        <input type="file" class="six wide column" id="lampiran-first" name="foto" accept="application/pdf,image/*" autocomplete="off">
		        <div class="ui button file">
		          Browse...
		        </div>
		      </div>
        </div>
        <div class="field">
          <label>Photograph for closing finding / Foto untuk tindak lanjut temuan</label>
          <div class="ui fluid file input action">
		        <input type="text" id="lampiran-sec-text" readonly>
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
