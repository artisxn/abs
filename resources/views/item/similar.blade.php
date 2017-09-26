@php
  $similar_products = array_get($item, 'SimilarProducts.SimilarProduct');
@endphp

@if(!empty($similar_products) and count($similar_products) > 0)
  <div class="uk-card-body">

    <h4 class="uk-heading-line"><span>関連商品</span></h4>

    <ul class="uk-list uk-list-bullet">
      @foreach($similar_products as $similar)
        <li>
          <a href="{{ route('asin', ['asin' => array_get($similar, 'ASIN')]) }}">
            {{ array_get($similar, 'Title') }}
          </a>
        </li>
      @endforeach
    </ul>
  </div>
@endif
