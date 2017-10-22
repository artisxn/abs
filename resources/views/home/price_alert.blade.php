@if($price_alert_posts->count() > 0)
  <h2 class="uk-heading-line uk-text-center">
    <span>価格変動チェック</span>
  </h2>

  <p>価格が20%以上増減したアイテム</p>

  <div class="uk-section uk-section-small uk-section-secondary uk-padding">
    <div class="uk-container">

      <table class="uk-table uk-table-divider uk-table-middle">
        <tbody>
        @foreach($price_alert_posts as $post)
          <tr>
            <td>
              @if($post->category_id === 2)
                <span class="uk-icon-button uk-background-default uk-text-success" uk-icon="icon: arrow-up"></span>
              @elseif($post->category_id === 3)
                <span class="uk-icon-button uk-background-default uk-text-danger" uk-icon="icon: arrow-down"></span>
              @endif

            </td>
            <td><a href="{{ route('asin', $post->excerpt) }}">{{ str_limit($post->title, 200) }}</a></td>
            <td class="uk-text-nowrap">
              @if($post->category_id === 2)
                <span class="uk-text-success">{{ $post->body }}</span>
              @elseif($post->category_id === 3)
                <span class="uk-text-danger">{{ $post->body }}</span>
              @endif
            </td>
            <td class="uk-text-nowrap">{{ $post->updated_at }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endif