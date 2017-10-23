<td>{{ $notification->created_at }}</td>
<td>

  @if(array_get($notification->data, 'category') === 'up')
    <span class="uk-icon-button uk-background-default uk-text-success" uk-icon="icon: arrow-up"></span>
  @elseif(array_get($notification->data, 'category') === 'down')
    <span class="uk-icon-button uk-background-default uk-text-danger" uk-icon="icon: arrow-down"></span>
  @endif

  <a href="{{ route('asin', array_get($notification->data, 'asin')) }}">
    {{ str_limit(array_get($notification->data, 'title'), 200) }}
  </a>

  @if(array_get($notification->data, 'category') === 'up')
    <span class="uk-text-success">{{ array_get($notification->data, 'body') }}</span>
  @elseif(array_get($notification->data, 'category') === 'down')
    <span class="uk-text-danger">{{ array_get($notification->data, 'body') }}</span>
  @endif

</td>
