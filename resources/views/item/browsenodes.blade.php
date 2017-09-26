@php
  $browsenodes =  array_get($item,'BrowseNodes');
@endphp

<div class="uk-card-body">
  <ul class="uk-breadcrumb">
    @while ($browsenodes = array_get($browsenodes, 'BrowseNode'))
      @php
        if(!array_has($browsenodes, 'BrowseNodeId')){
          $browsenodes = head($browsenodes);
        }

        $node_id = array_get($browsenodes, 'BrowseNodeId');
        $node_name = array_get($browsenodes, 'Name');
      @endphp

      <li><a href="{{ route('browse', $node_id) }}">{{ $node_name }}</a></li>

      @php
        $browsenodes = array_get($browsenodes, 'Ancestors');
      @endphp
    @endwhile
  </ul>
</div>
