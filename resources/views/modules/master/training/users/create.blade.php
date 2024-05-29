@if($users->count() > 0)
<div class="field" id="show-users">
    <table class="ui celled structured table">
        <thead>
            <tr>
                <th class="center aligned">No</th>
                <th class="center aligned">Name</th>
                <th class="center aligned">Role</th>
                <th class="center aligned">Company</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $key => $user)
            <tr>
                <td class="center aligned">{{ $key+1 }}</td>
                <td>
                    <img class="ui avatar image" src="{{ $user->showfotopath() }}">
                    {!! $user->display !!}
                </td>
                <td>{!! $user->showroles() !!}</td>
                <td>{!! $user->siteOn() !!}</td>
                <td>
                    <div class="ui toggle checkbox userchecked">
                        <input type="checkbox" name="userchecked[]" class="mfschecked" value="{{ $user->id }}">
                        <label>&nbsp;</label>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="field">
    @include('pagination.custom', ['paginator' => $users])
</div>
@else
<div class="ui center aligned mfs placeholder segment">
    <div class="ui icon header">
        <i class="search icon"></i>
        We don't have any person matching your filter query
    </div>
</div>
@endif
