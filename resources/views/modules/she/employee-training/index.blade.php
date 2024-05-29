@extends('layouts.list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
@append

@section('js')
    <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>
@append

@section('filters')
<div class="field">
	<select id="company" name="filter[company]" class="ui fluid search dropdown">
        {!! App\Models\Master\Site::options('name','id',[
          'filters' => [
            function ($site) {
                $site->whereIn('id', auth()->user()->site->pluck('id')->toArray());
              },
            ]
          ], 'Choose Company') !!}
      </select>
</div>
<div class="field">
	<select id="type" name="filter[type]" class="ui fluid search dropdown">
    {!! App\Models\Master\TypeTraining::options('name','id',[], 'Choose Training Type') !!}
  </select>
</div>


<button type="button" class="ui teal icon filter button" data-content="Cari Data">
	<i class="search icon"></i>
</button>
<button type="reset" class="ui icon reset button" data-content="Bersihkan Pencarian">
	<i class="refresh icon"></i>
</button>
@endsection

@section('js-filters')
d.name = $("input[name='filter[name]']").val();
d.company = $("select[name='filter[company]']").val();
d.type = $("select[name='filter[type]']").val();
@endsection

@section('toolbars')
	   <button type="button" class="ui blue @if($pagePerms != '' && !auth()->user()->can($pagePerms.'-add')) disabled @endif button add-page">
            <i class="add icon"></i>
            Create New Data
        </button>
@endsection

@section('rules')
<script type="text/javascript">
	formRules = {
		judul: 'empty',
		sub_judul: 'empty',
		url: 'url',
	};
</script>
@endsection
