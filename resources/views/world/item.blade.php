<tr>
  @if($loop->first or !isset($world_asins))
    <td
      @if(isset($world_asins) and $world_asins->count() > 0)
      rowspan="{{ $world_asins->count() }}"
      @endif
    ><a href="{{ route('world.show', $world_item->asin) }}">
        {{ $world_item->asin }}
        / {{ $world_item->ean }}
      </a>
    </td>
  @endif
  <td>{{ $world_item->country }}</td>
  <td>{{ $world_item->binding->binding }}
    @unless(empty($world_item->browses))
      <div>
        <button class="uk-button uk-button-text" type="button">
          <span uk-icon="icon: list"></span>

        </button>
        <div uk-drop>
          <div class="uk-card uk-card-body uk-card-default">
            <ul class="uk-list uk-list-bullet">
              @foreach($world_item->browses->reverse() as $browse)
                <li>{{ $browse->title }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    @endunless
  </td>
  <td>{{ $world_item->title }}
    @unless(empty($world_item->editorial_review))
      <div>
        <button class="uk-button uk-button-text" type="button">
          <span uk-icon="icon: comment"></span>
          説明
        </button>
        <div uk-drop>
          <div class="uk-card uk-card-body uk-card-default">
            {{ $world_item->editorial_review }}
          </div>
        </div>
      </div>
    @endunless
  </td>
  <td>{{ $world_item->availability->availability }}</td>
  <td class="uk-text-right uk-text-nowrap">
    {{ $world_item->lowest_new_formatted_price ?? 0 }}
    <span class="uk-badge uk-background-secondary">{{ $world_item->total_new ?? 0 }}</span>
  </td>
  <td> {{ $world_item->updated_at->format('m/d H:i') }}</td>
</tr>
