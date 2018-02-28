@php
  $creators = data_get($item, 'ItemAttributes.Creator');
  if(is_array($creators)){
  $creator = implode(' ', $creators);
  }elseif(is_string($creators)){
  $creator = $creators;
  }
@endphp

@unless(empty($creator))
  <li itemscope itemtype="http://schema.org/CreativeWork">作者(Creator)：
    <span itemprop="author">
          <a href="{{ route('search', ['category' => 'All', 'keyword' => $creator]) }}">
          {{ $creator }}
        </a>
        </span>
  </li>
@endunless
