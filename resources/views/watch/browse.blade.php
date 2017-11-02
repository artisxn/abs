<h3>カテゴリー({{ $browse_watches->total() }})</h3>

@if($browse_watches->count() > 0)
  {{ $browse_watches->links() }}

  <ul class="uk-list uk-list-striped">
    @foreach($browse_watches as $watch)
      <li>
        @feature('csv_download')
        <a href="{{ route('download.category', $watch->browse_id) }}"
           class="uk-button uk-button-default uk-button-small">CSV</a>
        @endfeature

        <a href="{{ route('browse', $watch->browse_id) }}">
          {{ $watch->browse->title }}
          <span class="uk-badge">
            {{ $watch->browse_items_count }}
          </span>
        </a>
        [{{ $watch->browse->id }}]

      </li>
    @endforeach
  </ul>

  {{ $browse_watches->links() }}

@endif
