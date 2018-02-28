@php
  $authors = data_get($item, 'ItemAttributes.Author');
  if(is_array($authors)){
  $author = implode(' ', $authors);
  }elseif(is_string($authors)){
  $author = $authors;
  }
@endphp

@unless(empty($author))
  <li itemscope itemtype="http://schema.org/CreativeWork">著者(Author)：
    <span itemprop="author">
        <a href="{{ route('search', ['category' => 'All', 'keyword' => $author]) }}">
          {{ $author }}
        </a>
        </span>
  </li>
@endunless
