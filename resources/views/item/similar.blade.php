@if(isset($similar_products) and count($similar_products) > 0)
  <div class="uk-card-body">
    <h4>関連商品</h4>
    <ul>
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
