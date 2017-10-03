@if($pickup_posts->count() > 0)
  <h2 class="uk-heading-line uk-text-center">
    <span>ピックアップ</span>
  </h2>

  <div class="uk-section uk-section-small uk-section-muted uk-padding">
    <div class="uk-container">
      <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
        @foreach($pickup_posts as $post)
          <div>
            {!! $post->body !!}
          </div>
        @endforeach
      </div>
    </div>
  </div>

@endif
