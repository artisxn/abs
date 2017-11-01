<?php

namespace App\Jobs\World;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

use Revolution\Amazon\ProductAdvertising\AmazonClient;

use ApaiIO\ApaiIO;
use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Request\GuzzleRequest;
use ApaiIO\ResponseTransformer\XmlToArray;
use GuzzleHttp\Client;

use App\Repository\Browse\BrowseRepositoryInterface as Browse;
use App\Repository\WorldItem\WorldItemRepositoryInterface as WorldItem;

class WorldWatchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    public $asins;

    /**
     * @var string
     */
    public $country;

    /**
     * @var AmazonClient
     */
    protected $amazon;

    /**
     * Create a new job instance.
     *
     * @param array  $asins
     * @param string $country
     *
     */
    public function __construct(array $asins, string $country = 'JP')
    {
        $this->asins = $asins;
        $this->country = $country;
    }

    /**
     * Execute the job.
     *
     * @param Browse    $browseRepository
     * @param WorldItem $worlditemRepository
     *
     * @return void
     */
    public function handle(Browse $browseRepository, WorldItem $worlditemRepository)
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

        if (empty($items)) {
            return;
        }

        foreach ($items as $item) {
            if (!is_array($item)) {
                continue;
            }

            $world_item = $worlditemRepository->create($item, $this->country);

            if (empty($world_item)) {
                continue;
            }

            $browse_nodes = abs_browse_nodes($item);
            if (!empty($browse_nodes)) {
                $browseRepository->createNodes($browse_nodes);

                $world_item->browses()->sync(array_values($browse_nodes));
            }
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

        $items = array_get($results, 'Items.Item', []);
        if (count($this->asins) === 1) {
            $items = [$items];
        }

        return $items;
    }

    /**
     * @return AmazonClient
     */
    private function factory()
    {
        $client = new Client();

        $request = new GuzzleRequest($client);
        $request->setScheme('https');

        $world_config = config('amazon-world.locales.' . $this->country);
        info($world_config);

        $conf = new GenericConfiguration();

        $conf->setCountry(array_get($world_config, 'tld'))
             ->setAccessKey(array_get($world_config, 'api_key'))
             ->setSecretKey(array_get($world_config, 'api_secret'))
             ->setAssociateTag(array_get($world_config, 'tag'))
             ->setResponseTransformer(new XmlToArray())
             ->setRequest($request);

        $apaiio = new ApaiIO($conf);

        return new AmazonClient($apaiio);
    }
}
