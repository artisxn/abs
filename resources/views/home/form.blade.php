<form action="{{ action('AmazonController@search') }}" method="get">
  {{ Form::select('category', config('amazon.form'), $category) }}

  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

    <input class="mdl-textfield__input" type="text" id="search_keyword" name="keyword" value="{{ $keyword or '' }}">
    <label class="mdl-textfield__label" for="search_keyword">検索...</label>
  </div>

  <button type="submit" id="search_button" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab">
    <i class="material-icons">search</i>
  </button>

</form>
