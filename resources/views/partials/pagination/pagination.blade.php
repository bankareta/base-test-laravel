@if ($paginator->lastPage() > 1)
  <div class="ui right floated pagination menu">
    <a class="icon item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}" href="{{ $paginator->url(1) }}">
      <i class="left chevron icon"></i>
    </a>
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
      <a class="item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}" href="{{ $paginator->url($i) }}">{{ $i }}</a>
    @endfor
    <a class="icon item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}" href="{{ $paginator->url($paginator->currentPage()+1) }}">
      <i class="right chevron icon"></i>
    </a>
  </div>
@endif
