<div class="uk-card uk-card-default uk-margin-bottom"
     itemscope
     itemtype="http://schema.org/Product">


  {{--    @include('asin.header')--}}


  @include('item.browsenodes')


  @include('item.image')

  @include('item.editorial')

  @include('item.info')

  @include('asin.imageset')

  @auth
    @include('asin.graph')
  @endauth

  @include('asin.histories')

  @include('item.similar')


  @include('item.amazon')
</div>
