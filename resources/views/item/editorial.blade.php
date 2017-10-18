@php
  $reviews = array_get($item, 'EditorialReviews.EditorialReview');
@endphp

@unless(empty($reviews))
  <div class="uk-card-body">
    @each('item.review', $reviews, 'review')
  </div>
@endunless
