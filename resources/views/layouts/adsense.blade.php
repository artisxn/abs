@isset($asin_item)
    @unless(data_get($asin_item->item_attribute->attributes,'IsAdultProduct'))
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- abs -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-5342783238467976"
             data-ad-slot="2645629896"
             data-ad-format="auto"></ins>
        <script>
          (adsbygoogle = window.adsbygoogle || []).push({})
        </script>
    @endunless
@endisset
