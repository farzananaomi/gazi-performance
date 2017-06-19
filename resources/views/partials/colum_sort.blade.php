<a href="{{ $link.(str_contains($link, '?')?'&':'?')."sorts[$key]=desc" }}"><i class="fa fa-sort-amount-desc sort-ctrl {{  $sort == 'desc'? 'sort-active':'' }}" aria-hidden="true"></i>  </a>
{{ $label }}
<a href="{{ $link.(str_contains($link, '?')?'&':'?')."sorts[$key]=asc" }}">  <i class="fa fa-sort-amount-asc sort-ctrl {{ $sort == 'asc'? 'sort-active':'' }}" aria-hidden="true"></i></a>
