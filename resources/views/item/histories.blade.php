@if(isset($histories) and count($histories) > 0)
  <div class="uk-card-body">
    <h4 class="uk-heading-line"><span>履歴</span></h4>

    <div class="uk-overflow-auto">

      <table class="uk-table uk-list-striped uk-table-hover uk-table-divider uk-table-small">
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
        @foreach($histories as $history)
          <tr>
            <td>{{ $history->day->toDateString()}}</td>
            <td>{{ $history->rank }}</td>
            <td>{{ $history->availability }}</td>
            <td>{{ $history->lowest_new_price }}</td>
            <td>{{ $history->total_new }}</td>
            <td>{{ $history->lowest_used_price }}</td>
            <td>{{ $history->total_used }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endif
