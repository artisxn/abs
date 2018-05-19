<div class="uk-card uk-card-default uk-margin-bottom"
     itemscope
     itemtype="http://schema.org/Product">

    @include('asin.header')

    @feature('adsense')
    @unless(data_get($asin_item->item_attribute->attributes,'IsAdultProduct'))
        @include('layouts.adsense')
    @endunless
    @endfeature

    @include('item.browsenodes')


    @include('asin.image')

    @include('item.editorial')

    @include('item.feature')

    @include('item.info')

    @include('asin.imageset')

    @include('asin.graph')

    @include('asin.histories')

    @include('item.similar')


    @include('item.amazon')
</div>
