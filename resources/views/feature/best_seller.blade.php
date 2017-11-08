<div class="uk-overflow-auto">
  <table class="uk-table uk-table-striped uk-table-hover uk-table-divider uk-table-small">
    <caption>ベストセラー</caption>

    <tbody>
    @foreach($best_sellers as $item)
      <tr>
        <td class="uk-text-right">{{ $item->rank }}</td>
        <td>
          <a href="{{ route('asin', $item->asin) }}">{{ $item->title or $item->asin}}</a></td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>

