@unless(empty(array_get($item, 'EditorialReviews.EditorialReview')))
  <div class="uk-card-body">
    <h4>{{ array_get($item, 'EditorialReviews.EditorialReview.Source') }}</h4>
    <p itemprop="description">{!! array_get($item, 'EditorialReviews.EditorialReview.Content') !!}
    </p>
  </div>
@endunless
