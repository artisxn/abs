<div class="uk-card-body">
  <ul class="uk-list uk-list-bullet">

    @php
      $publishers = array_get($item, 'ItemAttributes.Publisher');
      if(is_array($publishers)){
      $publisher = implode(', ', $publishers);
      }elseif(is_string($publishers)){
      $publisher = $publishers;
      }
    @endphp

    @unless(empty($publisher))

      <li itemscope itemtype="http://schema.org/CreativeWork">発売元(Publisher)：<span
          itemprop="publisher">
        <a
          href="{{ route('search', ['category' => 'All', 'keyword' => $publisher]) }}">
          {{ $publisher }}
        </a>
      </span>
      </li>
    @endunless

    @php
      $authors = array_get($item, 'ItemAttributes.Author');
      if(is_array($authors)){
      $author = implode(', ', $authors);
      }elseif(is_string($authors)){
      $author = $authors;
      }
    @endphp

    @unless(empty($author))
      <li>著者(Author)：
        <span itemprop="author">
        <a
          href="{{ route('search', ['category' => 'All', 'keyword' => $author]) }}">
          {{ $author }}
        </a>
        </span>
      </li>
    @endunless

    @php
      $creators = array_get($item, 'ItemAttributes.Creator');
      if(is_array($creators)){
      $creator = implode(', ', $creators);
      }elseif(is_string($creators)){
      $creator = $creators;
      }
    @endphp

    @unless(empty($creator))
      <li>作者(Creator)：
        <span itemprop="author">
          <a
            href="{{ route('search', ['category' => 'All', 'keyword' => $creator]) }}">
          {{ $creator }}
        </a>
        </span>
      </li>
    @endunless

    <li>発売日：<span itemprop="releaseDate">
        {{ array_get($item, 'ItemAttributes.ReleaseDate') }}
      </span>
    </li>

    <li itemscope itemtype="http://schema.org/Offer">新品価格：
      <span itemprop="priceCurrency"
            content="{{ array_get($item, 'OfferSummary.LowestNewPrice.CurrencyCode') }}"></span>
      <span itemtype="http://schema.org/Offer" itemprop="price"
            content="{{ array_get($item, 'OfferSummary.LowestNewPrice.Amount') }}"></span>
      {{ array_get($item, 'OfferSummary.LowestNewPrice.FormattedPrice') }}
    </li>

    <li>中古価格：
      {{ array_get($item, 'OfferSummary.LowestUsedPrice.FormattedPrice') }}
    </li>

    <li>在庫：
      {{ array_get($item, 'Offers.Offer.OfferListing.Availability') }}
    </li>

    <li>ランキング：{{ array_get($item, 'SalesRank') }} ({{ array_get($item, 'ItemAttributes.Binding') }})</li>

    @php
      $review_url = array_get($item, 'ItemLinks.ItemLink.2.URL');
    @endphp

    @if(str_contains($review_url, '/review/'))
      <li>
        <a href="{{ $review_url }}" target="_blank" rel="nofollow">
          <i class="fa fa-amazon" aria-hidden="true"></i>
          Amazonでレビューを見る</a>
      </li>
    @endif
  </ul>

</div>
