@unless(empty(array_get($review, 'Source')))
  <h4 class="uk-heading-line"><span>{{ array_get($review, 'Source') }}</span></h4>

  <p itemprop="description">{!! array_get($review, 'Content') !!}</p>
@endunless
