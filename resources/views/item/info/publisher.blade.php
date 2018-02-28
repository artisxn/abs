@php
  $publishers = data_get($item, 'ItemAttributes.Publisher');
  if(is_array($publishers)){
  $publisher = implode(' ', $publishers);
  }elseif(is_string($publishers)){
  $publisher = $publishers;
  }
@endphp

@unless(empty($publisher))
  <li itemscope itemtype="http://schema.org/CreativeWork">発売元(Publisher)：
    <span itemprop="publisher">
          <a href="{{ route('search', ['category' => 'All', 'keyword' => $publisher]) }}">
            {{ $publisher }}
          </a>
      </span>
  </li>
@endunless
