<h2>ASINリストをインポート</h2>

<form action="{{ route('import.asin') }}"
      method="post"
      enctype="multipart/form-data">
  {{ csrf_field() }}

  <div class="uk-margin" uk-margin>
    <div uk-form-custom="target: true">
      <input type="file" name="csv" accept="text/csv,.csv">
      <input class="uk-input uk-form-width-medium" type="text"
             placeholder="ASINリスト(CSV)" disabled>
    </div>
    <button class="uk-button uk-button-primary">インポート</button>
  </div>

</form>

