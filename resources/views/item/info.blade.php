<div class="uk-card-body">
  <h4 class="uk-heading-line"><span>商品情報</span></h4>

  <ul class="uk-list uk-list-bullet">
    <li>ASIN：
      <a href="{{ route('asin', data_get($item, 'ASIN')) }}">
        {{ data_get($item, 'ASIN') }}
      </a>
    </li>

    <li>
      JAN/EAN : {{ data_get($item, 'ItemAttributes.EAN') }}
    </li>

    @include('item.info.publisher')
    @include('item.info.brand')
    @include('item.info.author')
    @include('item.info.creator')

    <li>発売日：<span itemprop="releaseDate">
        {{ data_get($item, 'ItemAttributes.ReleaseDate') }}
      </span>
    </li>

    @include('item.info.price')

    @include('item.info.offer')

    @include('item.info.rank')

    @include('item.info.review')

  </ul>

</div>
