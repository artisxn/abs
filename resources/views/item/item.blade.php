<?php
$url = array_get($item, 'DetailPageURL');

//asinページならamazonのURL
$item_url = empty($items) ? $url : route('asin', ['asin' => array_get($item, 'ASIN')]);

$item_title = array_get($item, 'ItemAttributes.Title');

if (!is_null(array_get($item, 'LargeImage'))) {
  $img_size = 'LargeImage';
} elseif (!is_null(array_get($item, 'MediumImage'))) {
  $img_size = 'MediumImage';
} elseif (!is_null(array_get($item, 'SmallImage'))) {
  $img_size = 'SmallImage';
}

$similar_products = array_get($item, 'SimilarProducts.SimilarProduct');
?>

<div class="uk-card uk-card-default uk-margin-bottom"
     itemscope
     itemtype="http://schema.org/Product">

  <div class="uk-card-header  uk-card-primary">
    <h2 class="uk-card-title">
      <a href="{{ $item_url }}">
        <span itemprop="name">{{ $item_title }}</span>
      </a>
    </h2>
  </div>




  @if( ! empty($img_size))
    <div class="uk-card-media">
      <a href="{{ $url }}" target="_blank">
        <img src="{{ array_get($item, $img_size . '.URL') }}"
             width="{{ array_get($item, $img_size . '.Width') }}"
             height="{{ array_get($item, $img_size . '.Height') }}"
             border="0"
             title="{{ $item_title }}"
             alt="{{ $item_title }}"
             itemprop="image">
      </a>
    </div>
  @endif


  @if(array_get($item, 'EditorialReviews.EditorialReview', '') != '')
    <div class="uk-card-body">
      <h4>{{ array_get($item, 'EditorialReviews.EditorialReview.Source') }}</h4>
      <p itemprop="description">{!! array_get($item, 'EditorialReviews.EditorialReview.Content') !!}
      </p>
    </div>

  @endif

  <div class="uk-card-body">
    <ul>
      <li itemscope itemtype="http://schema.org/CreativeWork">Publisher：<span
          itemprop="publisher">{{ array_get($item, 'ItemAttributes.Publisher') }}</span></li>
      <li>発売日：<span itemprop="releaseDate">{{ array_get($item, 'ItemAttributes.ReleaseDate') }}</span></li>
      <li itemscope itemtype="http://schema.org/Offer">価格：<span itemprop="priceCurrency"
                                                                content="{{ array_get($item, 'OfferSummary.LowestNewPrice.CurrencyCode') }}"></span><span
          itemtype="http://schema.org/Offer" itemprop="price"
          content="{{ array_get($item, 'OfferSummary.LowestNewPrice.Amount') }}"></span>{{ array_get($item, 'OfferSummary.LowestNewPrice.FormattedPrice') }}
      </li>
      <li>ランキング：{{ array_get($item, 'SalesRank') }}</li>
    </ul>
  </div>

  @include('item.watchlist')

  @include('item.histories')

  @include('item.similar')


  <div class="uk-card-footer">
    <a href="{{ $url }}"
       target="_blank"
       class="uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom">
      Amazonで詳細を見る
    </a>
  </div>
</div>

<?php
//dump($item);
?>
