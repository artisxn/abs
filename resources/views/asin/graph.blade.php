<div class="uk-card-body uk-visible@s">
  <h4 class="uk-heading-line"><span>グラフ</span></h4>
  @auth
    <history-graph asin="{{ $asin_item->asin }}"></history-graph>
  @endauth

  @guest
    <div class="uk-alert-warning" uk-alert>
      <p>グラフはログイン中のみ表示されます。</p>
    </div>
  @endguest

</div>
