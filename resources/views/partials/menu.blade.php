@if (auth()->user())
    @foreach($items as $key => $item)
        @if(isset($group[$key - 1]) && isset($item->data['group']) && $group[$key - 1] != $item->data['group'])
            <div class="ui sidemenu divider dividersidebar" data-group="{{ $group[$key - 1] }}"></div>
        @endif
        @if(isset($item->data['group']))
            @php
            $group[$key] = $item->data['group'];
            @endphp
        @endif
        @if(!$item->hasChildren())
            @php
            $filter =$item->perms;
            $confirm = auth()->user()->getAllPermissions()->filter(function ($q) use ($filter) {
                return starts_with($q->name, $filter);
            })->pluck('name');
            // $confirm = auth()->user()->getAllPermissions()->filter(function ($q) use ($filter) {
            //     return $q->name === $filter.'-view';
            // })->pluck('name');
            @endphp
            @if($confirm->count() > 0)
                <a href="{!! $item->url() !!}" class="{{ $item->isActive ? 'active' : '' }} item sidebarmenumfs" tabindex="{{ $item->id }}" data-group="{{ $item->data['group'] }}">
                    <i class="{{ $item->icon }} icon"></i>{!! $item->title !!}
                </a>
            @endif
        @else
            @php
            $filter =$item->perms;
            $confirm = auth()->user()->getAllPermissions()->filter(function ($q) use ($filter) {
              if(is_array($filter))
              {
                foreach($filter as $key => $f)
                {
                    if(false !== stristr($q->name, $f))
                    {
                       return true;
                    }
                }
              }else{
                return false !== stristr($q->name, $filter);
              }
            })->pluck('name');

            $access = false;
            @endphp
            @if($item->hasChildren())
              @foreach($item->children() as $child)
                @php
                  $confirm = auth()->user()->getAllPermissions()->filter(function ($q) use ($filter) {
                      return starts_with($q->name,$filter);
                  })->pluck('name');
                  if($confirm->count() > 0)
                  {
                    $access = true;
                  }
                @endphp
              @endforeach
            @endif
            @if($confirm->count() > 0 && $access)
                <div class="ui title {{ $item->title == $subtitle ? 'active' : '' }} sidebarmenumfs" tabindex="{{ $item->id }}" data-group="{{ $item->data['group'] }}">
                    <i class="{{ $item->icon }} icon"></i>
                    {!! $item->title !!}
                    <i class="dropdown right icon" style="float:right"></i>
                </div>
                <div class="ui content {{ $item->isActive ? 'active' : '' }}">
                    @foreach ($item->children() as $index => $child)
                      @if(isset($child->data['cluster']) && $child->data['cluster'])
                        <div class="ui divider" style="margin-right: 30px; margin-left: 30px; display: block !important;">
                            <span class="float-right" style="float: right;color: gray;text-transform: none !important;">
                              <small><i>{!! $child->title !!}</i></small>
                            </span>
                        </div>
                      @else
                        @if(isset($childgroup[$index - 1]) && isset($child->data['group']) && $childgroup[$index - 1] != $child->data['group'])
                            <div class="ui sidemenu divider dividersidebarchild" data-childgroup="{{ $childgroup[$index - 1] }}"></div>
                        @endif
                        @if(isset($child->data['group']))
                            @php
                                $childgroup[$index] = $child->data['group'];
                            @endphp
                        @endif

                        @php
                        $filter =$child->perms;
                        $confirm = auth()->user()->getAllPermissions()->filter(function ($q) use ($filter) {
                            return starts_with($q->name,$filter);
                        })->pluck('name');
                        @endphp

                        @if ($confirm->count() > 0)
                            <a href="{!! $child->url() !!}" class="{{ $child->isActive ? 'active' : '' }} item sidebarchildmenumfs" {{ isset($child->data['group']) ? 'data-childgroup='.$child->data['group'].'' : '' }}>
                                <i class="{{ $child->isActive ? 'caret right' : '' }} icon"></i>{!! $child->title !!}
                            </a>
                        @endif
                      @endif
                    @endforeach
                </div>
            @endif
        @endif
    @endforeach
@else

@endif
