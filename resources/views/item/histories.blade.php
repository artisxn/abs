@if(isset($histories) and count($histories) > 0)
  <div class="uk-card-body">
    <h4>履歴</h4>
    <div class="uk-overflow-auto">

      <table class="uk-table uk-list-striped uk-table-hover uk-table-divider uk-table-small">
        <thead>
        <tr>
          <th>日付</th>
          <th>ランキング</th>
          <th>価格(新品)</th>
          <th>価格(中古)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($histories as $history)
          <tr>
            <td>{{ $history->day->toDateString()}}</td>
            <td>{{ $history->rank or '' }}</td>
            <td>{{ $history->offer['LowestNewPrice']['FormattedPrice'] or '' }}</td>
            <td>{{ $history->offer['LowestUsedPrice']['FormattedPrice'] or '' }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endif
