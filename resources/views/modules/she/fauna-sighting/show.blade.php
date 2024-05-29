@extends('layouts.form')

@section('styles')

@endsection

@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGhGk3DTCkjF1EUxpMm5ypFoQ-ecrS2gY&callback=initMap&v=weekly" defer></script>
<script type="text/javascript">
  $('.maxdate').calendar({
      type: 'date',
      initialDate: new Date(),
      maxDate: new Date(),
      text: {
      },
  });
  let map;

  function initMap() {
    dinLang = {{ $lang }};
    dinLat = {{ $lat }};
    const mapOptions = {
      zoom: 15,
      center: { lat: dinLat, lng: dinLang },
    };

    map = new google.maps.Map(document.getElementById("map"), mapOptions);

    const marker = new google.maps.Marker({
      position: { lat: dinLat, lng: dinLang },
      map: map,
    });
    const infowindow = new google.maps.InfoWindow({
      content: "<p>Marker Location:" + marker.getPosition() + "</p>",
    });

    google.maps.event.addListener(marker, "click", () => {
      infowindow.open(map, marker);
    });
  }

  window.initMap = initMap;
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
          <label>Username</label>
          <input type="text" name="name" placeholder="Contractor Name" value="{{ $record->name }}" readonly>
        </div>
        <div class="field">
          <label>Contractor</label>
          <input type="text" name="number" placeholder="Certificate Number" readonly value="{{ $record->contractor }}">
        </div>
      </div>
      <div class="three fields">
        <div class="field">
          <label>Mobile Phone No.</label>
          <input type="text" name="name" placeholder="Mobile Phone No." value="{{ $record->no_telp }}" readonly>
        </div>
        <div class="field">
          <label>Datetime Taken</label>
          <input type="text" name="name" placeholder="Contractor Name" value="{!! Helpers::DateToString(Carbon::createFromFormat('Y-m-d', $record->date_taken)).' '.$record->time_taken !!}" readonly>
        </div>
        <div class="field">
          <label>Flora / Fauna</label>
          <input type="text" name="number" placeholder="Flora / Fauna" readonly value="{{ $record->flora }}">
        </div>
      </div>
      <div class="field">
        <label>Location Details</label>
        <textarea readonly name="location_details" placeholder="Location Details" rows="3">{{ $record->location_details }}</textarea>
      </div>
      @if ($record->photo->count() > 0)
        <table class="ui celled structured table">
          <tbody>
              <tr>
                  <td class="center aligned field">
                      <label><u>Photo</u></label>
                      <div class="ui centered cards">
                          {!! $record->showCardFile('detail') !!}
                      </div>
                      <div id="showFileExistDelete"></div>
                  </td>
              </tr>
          </tbody>
        </table>
      @endif
      <table class="ui celled structured table">
        <tbody>
            <tr>
                @if ($record->video)
                  <td class="center aligned field" style="width: 50%;">
                    <label><u>Location Maps</u></label>
                    <div id="map" style="width:100%;height:400px;"></div>
                  </td>
                  <td class="center aligned field" style="width: 50%;">
                      <label><u>Video</u></label>
                      <video width="100%" height = '400px' controls>
                        <source src="{!! Helpers::showImgExtension($record->video->url,'viewer') !!}" type="video/mp4">
                        Your browser does not support HTML video.
                      </video>
                  </td>
                @else
                  <td class="center aligned field">
                    <label><u>Location Maps</u></label>
                    <div id="map" style="width:100%;height:400px;"></div>
                  </td>
                @endif
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
