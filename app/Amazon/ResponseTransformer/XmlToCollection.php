<?php
namespace App\Amazon\ResponseTransformer;

use ApaiIO\ResponseTransformer\ResponseTransformerInterface;

class XmlToCollection implements ResponseTransformerInterface
{
    /**
     * @param mixed $response
     *
     * @return \Illuminate\Support\Collection
     */
    public function transform($response)
    {
        $dom = simplexml_load_string($response);

        $elements = collect(json_decode(json_encode($dom), true));

        return $elements;
    }
}
