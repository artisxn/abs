@if($asin_item->histories->count() > 0)
  <div class="uk-card-body">
    <h4 class="uk-heading-line"><span>履歴</span></h4>

    <div class="uk-overflow-auto">

      <table class="uk-table uk-table-striped uk-table-hover uk-table-divider uk-table-small">
        <thead>
        <tr>
          <th>日付</th>
          <th>ランキング</th>
          <th>在庫</th>
          <th>新品価格</th>
          <th>新品出品数</th>
          <th>中古価格</th>
          <th>中古出品数</th>
        </tr>
        </thead>
        <tbody>
        @foreach($asin_item->histories as $history)
          <tr>
            <td>{{ $history->day }}</td>
            <td>{{ $history->rank }}</td>
            <td>{{ optional($history->availability)->availability }}</td>
            <td>{{ $history->priceFormat($history->lowest_new_price) }}</td>
            <td>{{ $history->total_new }}</td>
            <td>{{ $history->priceFormat($history->lowest_used_price) }}</td>
            <td>{{ $history->total_used }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endif
