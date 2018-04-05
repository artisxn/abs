<div class="uk-section uk-padding-remove-top">

  <form action="{{ route('search') }}" method="get" class="uk-grid-small" uk-grid>
    <div class="uk-width-1-4">

      {{ Form::select('category', config('amazon.form'), $category, ['class' => 'uk-select']) }}
    </div>

    <div class="uk-width-3-4 uk-search uk-search-default">

      <button id="search_icon" class="uk-search-icon-flip" uk-search-icon></button>
      <input id="search_keyword" name="keyword" value="{{ de($keyword) ?? '' }}" class="uk-search-input" type="search" placeholder="検索...">
    </div>


  </form>
</div>
{!! $search_json_ld !!}
