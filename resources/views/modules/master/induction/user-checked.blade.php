@if($users->count() > 0)
    @foreach($users as $user)
        <input type="hidden" name="participant[]" value="{{ $user->id }}">
    @endforeach
@endif
