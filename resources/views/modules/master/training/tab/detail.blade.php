<div class="field">
    <label>Training Title</label>
    <input type="text" name="title" placeholder="Training Title">
</div>
<div class="field">
  <label>Type Training</label>
  <select name="type_training_id" class="ui search selection dropdown">
    {!! \App\Models\Master\TypeTraining::options('name', 'id', [], 'Choose Training Type') !!}
  </select>
</div>
<div class="field">
    <label>Contents</label>
    <textarea name="contents" placeholder="Contents"></textarea>
</div>
<div class="field">
  <label>Company</label>
  <select name="site_id" class="ui search selection dropdown">
    {!! \App\Models\Master\Site::options('name', 'id', ['filters' => [
    function ($site) {
        $site->whereIn('id', auth()->user()->site->pluck('id')->toArray());
      },
    ]
  ], 'Choose Company') !!}
  </select>
</div>
<div class="ui two column grid">
  <div class="left aligned column">
    <a class="ui labeled icon button" href="{{ url($pageUrl) }}">
      <i class="chevron left icon"></i>
      Back
    </a>
  </div>
  <div class="right aligned column">
    <div class="ui right labeled icon button next" data-prev="first" data-tab="second">
      Next
      <i class="chevron right icon"></i>
    </div>
  </div>
</div>