@if ($paginator->lastPage() > 1)
<div class="ui pagination right menu">
    <a class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }} item" href="{{ $paginator->url(1) }}">
        <i class="chevron left icon"></i>
    </a>
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <a class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }} item" href="{{ $paginator->url($i) }}">
            {{ $i }}
        </a>
    @endfor
    <a class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }} item"  href="{{ $paginator->url($paginator->currentPage()+1) }}">
        <i class="chevron right icon"></i>
    </a>
</div>
@endif
