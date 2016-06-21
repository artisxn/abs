<?php
$url = array_get($item, 'DetailPageURL');

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

<div class="card-wide mdl-card mdl-shadow--8dp">
  <div class="mdl-card__title">
    <h2 class="mdl-card__title-text">
      <a href="{{ action('AmazonController@asin', ['asin' => array_get($item, 'ASIN')]) }}">
        {{ $item_title }}
      </a>
    </h2>
  </div>

  @if( ! empty($img_size))
    <div class="mdl-card__media">
      <a href="{{ $url }}" target="_blank">
        <img src="{{ array_get($item, $img_size . '.URL') }}"
             width="{{ array_get($item, $img_size . '.Width') }}"
             height="{{ array_get($item, $img_size . '.Height') }}"
             border="0"
             title="{{ $item_title }}"
             alt="{{ $item_title }}">
      </a>
    </div>
  @endif

  @if(array_get($item, 'EditorialReviews.EditorialReview', '') != '')
    <div class="mdl-card__supporting-text">
      <h4>{{ array_get($item, 'EditorialReviews.EditorialReview.Source') }}</h4>
      <p>{!! array_get($item, 'EditorialReviews.EditorialReview.Content') !!}
      </p>
    </div>

  @endif

  <div class="mdl-card__supporting-text">
    <ul>
      <li>Publisher：{{ array_get($item, 'ItemAttributes.Publisher') }}</li>
      <li>発売日：{{ array_get($item, 'ItemAttributes.ReleaseDate') }}</li>
      <li>価格：{{ array_get($item, 'OfferSummary.LowestNewPrice.FormattedPrice') }}</li>
      <li>ランキング：{{ array_get($item, 'SalesRank') }}</li>
    </ul>
  </div>

  @if(array_get($item, 'CustomerReviews.HasReviews') === 'true')

    <iframe height="500" src="{!! array_get($item, 'CustomerReviews.IFrameURL') !!}"></iframe>

  @endif

  @if(count($similar_products) > 0)
    <div class="mdl-card__supporting-text">
      <h4>関連商品</h4>
      <ul>
        @foreach($similar_products as $similar)
          <li>
            <a href="{{ action('AmazonController@asin', ['asin' => array_get($similar, 'ASIN')]) }}">
              {{ array_get($similar, 'Title') }}
            </a>
          </li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="mdl-card__actions mdl-card--border">
    <a href="{{ $url }}"
       target="_blank"
       class="mdl-button mdl-button--primary mdl-js-button mdl-js-ripple-effect mdl-button--raised">
      Amazonで詳細を見る
    </a>
  </div>
</div>
<?php
//dump($item);
?>
