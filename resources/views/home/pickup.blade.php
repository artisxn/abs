@if($pickup_posts->count() > 0)
  <h2 class="uk-heading-line uk-text-center">
    <span>ピックアップ</span>
  </h2>

  <div class="uk-section uk-section-small uk-section-muted uk-padding">
    <div class="uk-container">
      @foreach($pickup_posts as $post)
        {!! $post->body !!}
      @endforeach
    </div>
  </div>

@endif
