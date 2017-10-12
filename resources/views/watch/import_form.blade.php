@feature('jan_import')
<h4>JAN/EANリストをインポート</h4>

<div class="uk-alert-primary" uk-alert>
  <p>1列目にJAN/EANコードが並んだCSVに対応。</p>
</div>

@foreach ($errors->all() as $message)
  <div class="uk-alert-danger" uk-alert>
    <p>{{ $message }}</p>
  </div>
@endforeach

<form action="{{ route('watch.import') }}"
      method="post"
      enctype="multipart/form-data">
  {{ csrf_field() }}

  <div class="uk-margin" uk-margin>
    <div uk-form-custom="target: true">
      <input type="file" name="jan_csv" accept="text/csv,.csv">
      <input class="uk-input uk-form-width-medium" type="text"
             placeholder="JAN/EANリスト(CSV)" disabled>
    </div>
    <button class="uk-button uk-button-default">インポート</button>
  </div>

</form>

@endfeature
