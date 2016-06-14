<?php
namespace App\Service;

use ApaiIO\Configuration\GenericConfiguration;

use ApaiIO\Operations\Search;
use ApaiIO\Operations\Lookup;
use ApaiIO\Operations\BrowseNodeLookup;

use ApaiIO\ApaiIO;
use ApaiIO\Request\GuzzleRequest;
use GuzzleHttp\Client;

use App\Amazon\ResponseTransformer\XmlToCollection;

class AmazonService
{
    /**
     * @var ApaiIO
     */
    protected $apai;

    /**
     * AmazonService constructor.
     */
    public function __construct()
    {
        $conf    = new GenericConfiguration();
        $client  = new Client();
        $request = new GuzzleRequest($client);

        $conf->setCountry(config('amazon.country'))
             ->setAccessKey(config('amazon.api_key'))
             ->setSecretKey(config('amazon.api_secret_key'))
             ->setAssociateTag(config('amazon.associate_tag'))
             ->setResponseTransformer(new XmlToCollection())
             ->setRequest($request);
        $this->apai = new ApaiIO($conf);
    }

    /**
     * @param string $category
     * @param string $keyword
     * @param int $page
     *
     * @return \Illuminate\Support\Collection|mixed
     */
    public function search($category, $keyword, $page)
    {
        try {
            $search = new Search();
            $search->setCategory($category);
            $search->setKeywords($keyword);
            if ($page > 0) {
                $search->setPage($page);
            }
            $search->setResponseGroup(['Large']);
            $result = $this->apai->runOperation($search);
        } catch (\Exception $e) {
            $result = collect([]);
        }

        return $result;
    }

    /**
     * @param string $node
     *
     * @return \Illuminate\Support\Collection|mixed
     */
    public function browse($node)
    {
        try {
            $browseNodeLookup = new BrowseNodeLookup();
            $browseNodeLookup->setNodeId($node);
            $browseNodeLookup->setResponseGroup(['TopSellers']);
            $result = $this->apai->runOperation($browseNodeLookup);
        } catch (\Exception $e) {
            $result = collect([]);
        }

        return $result;
    }

    /**
     * @param string $asin
     *
     * @return \Illuminate\Support\Collection|mixed
     */
    public function item($asin)
    {
        try {
            $lookup = new Lookup();
            $lookup->setItemId($asin);

            $lookup->setResponseGroup(['Large']);
            $result = $this->apai->runOperation($lookup);
        } catch (\Exception $e) {
            $result = collect([]);
        }

        return $result;
    }
}
