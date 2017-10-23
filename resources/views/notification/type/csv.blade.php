<td>{{ $notification->created_at }}</td>
<td>
  <a href="{{ route('download.csv', array_get($notification->data, 'file')) }}">
    {{ array_get($notification->data, 'title') }}
  </a>
</td>
