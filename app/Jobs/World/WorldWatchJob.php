<?php

namespace App\Jobs\World;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Model\WorldItem;

use Revolution\Amazon\ProductAdvertising\AmazonClient;

use ApaiIO\ApaiIO;
use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Request\GuzzleRequest;
use ApaiIO\ResponseTransformer\XmlToArray;
use GuzzleHttp\Client;

class WorldWatchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected $asins;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @var AmazonClient
     */
    protected $amazon;

    /**
     * Create a new job instance.
     *
     * @param array  $asins
     * @param string $locale
     *
     */
    public function __construct(array $asins, string $locale = 'JP')
    {
        $this->asins = $asins;
        $this->locale = $locale;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        info(self::class);

        if (empty($this->asins)) {
            return;
        }

        if (count($this->asins) > 10) {
            return;
        }

        $this->amazon = $this->factory();

        $items = $this->get();

        foreach ($items as $item) {
            $this->create($item);
        }
    }

    /**
     * @return array
     */
    public function get()
    {
        $results = rescue(function () {
            return $this->amazon->setIdType('ASIN')->items($this->asins);
        }, []);

        $items = array_get($results, 'Items.Item');

        return $items;
    }

    public function create(array $item = null)
    {
        $asin = array_get($item, 'ASIN');

        if (empty($asin)) {
            return;
        }

        $ean = array_get($item, 'ItemAttributes.EAN');

        $rank = array_get($item, 'SalesRank');
        $title = array_get($item, 'ItemAttributes.Title');

        $availability = array_get($item, 'Offers.Offer.OfferListing.Availability');
        $lowest_new_price = array_get($item, 'OfferSummary.LowestNewPrice.Amount');
        $lowest_used_price = array_get($item, 'OfferSummary.LowestUsedPrice.Amount');
        $total_new = array_get($item, 'OfferSummary.TotalNew');
        $total_used = array_get($item, 'OfferSummary.TotalUsed');
        $editorial_review = array_get($item, 'EditorialReviews.EditorialReview.Content');

        WorldItem::updateOrCreate([
            'asin'    => $asin,
            'country' => $this->locale,
        ], compact([
            'ean',
            'title',
            'rank',
            'availability',
            'lowest_new_price',
            'lowest_used_price',
            'total_new',
            'total_used',
            'editorial_review',
        ]));
    }

    /**
     * @return AmazonClient
     */
    private function factory()
    {
        $tld = config('amazon.locales.' . $this->locale . '.tld');
        info($tld);

        $client = new Client();

        $request = new GuzzleRequest($client);
        $request->setScheme('https');

        $config = config('amazon-product');

        $conf = new GenericConfiguration();

        $conf->setCountry($tld)
             ->setAccessKey($config['api_key'])
             ->setSecretKey($config['api_secret_key'])
             ->setAssociateTag($config['associate_tag'])
             ->setResponseTransformer(new XmlToArray())
             ->setRequest($request);

        $apaiio = new ApaiIO($conf);

        return new AmazonClient($apaiio);
    }
}
