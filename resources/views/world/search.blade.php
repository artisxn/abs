<form action="{{ route('world.index') }}" method="get">

  <div class="uk-search uk-search-default uk-width-1-2">

    <button id="search_icon" class="uk-search-icon-flip" uk-search-icon></button>
    <input id="search_keyword" name="search"
           value="{{ request('search') }}"
           class="uk-search-input"
           type="search"
           placeholder="タイトル検索...">
  </div>

</form>
