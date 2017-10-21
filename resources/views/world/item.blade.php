<tr>
  @if($loop->first)
    <td
      @if($world_asins->count() > 0)
      rowspan="{{ $world_asins->count() }}"
      @endif
    ><a href="{{ route('world.show', $world_item->asin) }}">{{ $world_item->asin }}
        / {{ $world_item->ean }}</a>
    </td>
  @endif
  <td>{{ $world_item->country }}</td>
  <td >{{ $world_item->binding->binding }}
    @unless(empty($world_item->browses))
      <details>
        <summary class="uk-button uk-button-text">ブラウズ</summary>
        <ul class="uk-list uk-list-bullet">
          @foreach($world_item->browses as $browse)
            <li>{{ $browse->title }}</li>
          @endforeach
        </ul>
      </details>
    @endunless
  </td>
  <td>{{ $world_item->title }}
    @unless(empty($world_item->editorial_review))
      <details>
        <summary class="uk-button uk-button-text">説明</summary>
        <div class="uk-section uk-section-default uk-section-xsmall uk-padding">
          <div class="uk-container">
            {{ $world_item->editorial_review }}
          </div>
        </div>
      </details>
    @endunless
  </td>
  <td>{{ $world_item->availability->availability }}</td>
  <td class="uk-text-right uk-text-nowrap">{{ $world_item->lowest_new_formatted_price or 0 }}</td>
  <td class="uk-text-right">{{ $world_item->total_new or 0 }}</td>
  {{--<td class="uk-text-right">{{ $world_item->lowest_used_price or 0 }}</td>--}}
  {{--<td class="uk-text-right">{{ $world_item->total_used or 0 }}</td>--}}
</tr>
