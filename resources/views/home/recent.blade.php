<h2 class="uk-heading-line uk-text-center"><span>最近見られてるアイテム</span></h2>

@if($recent_items->count() > 0)
  <div class="uk-child-width-1-3@m uk-grid-small uk-grid-match" uk-grid>

    @foreach($recent_items as $item)
      @include('home.recent.item')
    @endforeach

  </div>
@endif
