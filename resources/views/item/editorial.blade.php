@php
  $reviews = array_get($item, 'EditorialReviews.EditorialReview', []);
@endphp

@if(filled($reviews))
  <div class="uk-card-body">
    @each('item.review', $reviews, 'review')
  </div>
@endif
