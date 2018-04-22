@unless(empty(data_get($review, 'Source')))
  <h4 class="uk-heading-line"><span>{{ abs_decode(data_get($review, 'Source')) }}</span></h4>

  <p itemprop="description">{!! abs_decode(data_get($review, 'Content')) !!}</p>
@endunless
