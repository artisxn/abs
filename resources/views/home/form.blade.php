<div class="uk-section">

  <form action="{{ route('search') }}" method="get" class="uk-grid-small" uk-grid>
    <div class="uk-width-1-4">

      {{ Form::select('category', config('amazon.form'), $category, ['class' => 'uk-select']) }}
    </div>

    <div class="uk-width-3-4 uk-search uk-search-default">

      <a href="" class="uk-search-icon-flip" uk-search-icon></a>
      <input id="search_keyword" name="keyword" value="{{ $keyword or '' }}" class="uk-search-input" type="search" placeholder="検索...">
    </div>


  </form>
</div>
