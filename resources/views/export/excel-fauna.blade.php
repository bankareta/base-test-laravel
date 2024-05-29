<table class="tbl-header">
    <thead>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th rowspan="3"></th>
            <th rowspan="3" colspan="2"></th>
            <th rowspan="3" colspan="5" style="vertical-align: middle">{{ !isset($title) ? '-' :$title }}</th>
            <th colspan="2"></th>
            <th></th>
        </tr>
        <tr>
            <th colspan="2"></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th colspan="2"></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
</table>
 
<table>
    <thead>
        <tr>
            <td></td>
            <td colspan="2" class="text-bold"><b>Company</b></td>
            <td colspan="2">{{ $divisi }}</td>
            <td class="text-bold"><b>Periode</b></td>
            <td colspan="2">{{ $periode }}</td>
        </tr>
        <tr>
            <th></th>
            <th><b>No</b></th>
            <th><b>Username</b></th>
            <th><b>Contractor</b></th>
            <th><b>Mobile Phone No.</b></th>
            <th><b>Datetime Taken</b></th>
            <th><b>Flora / Fauna</b></th>
            <th><b>Location Details</b></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($record as $key => $data)
            <tr>
                <td></td>
                <td>{{ $key+1 }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->contractor }}</td>
                <td>{{ $data->no_telp }}</td>
                <td>{{ Helpers::DateToString(Carbon::createFromFormat('Y-m-d', $data->date_taken)).' '.$data->time_taken }}</td>
                <td>{{ $data->flora }}</td>
                <td>{{ $data->location_details }}</td>
            </tr>
        @empty
            <tr>
                <td></td>
                <td colspan="7"><h5>Data tidak ditemukan</h5></td>
            </tr>
        @endforelse
    </tbody>
</table>