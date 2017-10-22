<ul class="uk-subnav uk-subnav-pill" uk-margin>
  <li @routeis('world.index')class="uk-active"@endrouteis><a href="{{ route('world.index') }}">ワールド</a></li>
  <li @routeis('world.new')class="uk-active"@endrouteis><a href="{{ route('world.new') }}">新着</a></li>
  <li @routeis('world.api')class="uk-active"@endrouteis><a href="{{ route('world.api') }}">API</a></li>
</ul>
