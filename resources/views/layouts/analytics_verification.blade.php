@unless(empty(config('amazon.analytics_verification')))
  <meta name="google-site-verification" content="{{ config('amazon.analytics_verification') }}">
@endunless
