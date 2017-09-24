<ul class="uk-subnav uk-subnav-pill" uk-margin>
  <li{!! empty($browse_new) ? ' class="uk-active"' : '' !!}>
    <a href="{{ route('browse', $browse_id) }}">ランキング</a>
  </li>
  <li{!! !empty($browse_new) ? ' class="uk-active"' : '' !!}>
    <a href="{{ route('browse-new', $browse_id) }}">ニューリリース</a>
  </li>
</ul>
