@if($pickup_posts->count() > 0)
  <h2 class="uk-heading-line uk-text-center">
    <span>ピックアップ</span>
  </h2>

  @foreach($pickup_posts as $post)
    {!! $post->body !!}
  @endforeach
@endif
