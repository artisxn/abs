@php
  $brands = data_get($item, 'ItemAttributes.Brand');
  if(is_array($brands)){
  $brand = implode(' ', $brands);
  }elseif(is_string($brands)){
  $brand = $brands;
  }
@endphp

@unless(empty($brand))
  <li>ブランド(Brand)：
    <span itemprop="brand">
          <a href="{{ route('search', ['category' => 'All', 'keyword' => abs_decode($brand)]) }}">
            {{ abs_decode($brand) }}
          </a>
        </span>
  </li>
@endunless
