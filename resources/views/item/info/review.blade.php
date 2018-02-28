@php
  $review_url = data_get($item, 'ItemLinks.ItemLink.2.URL');
@endphp

@if(str_contains($review_url, '/review/'))
  <li>
    <a href="{{ $review_url }}" target="_blank" rel="nofollow noopener">
      <i class="fa fa-amazon" aria-hidden="true"></i>
      Amazonでレビューを見る</a>
  </li>
@endif
