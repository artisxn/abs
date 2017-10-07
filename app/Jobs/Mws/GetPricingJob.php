<?php

namespace App\Jobs\Mws;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GetPricingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Japan
        $serviceUrl = "https://mws.amazonservices.jp/Products/2011-10-01";

        $config = [
            'ServiceURL'    => $serviceUrl,
            'ProxyHost'     => null,
            'ProxyPort'     => -1,
            'ProxyUsername' => null,
            'ProxyPassword' => null,
            'MaxErrorRetry' => 3,
        ];

        $service = new \MarketplaceWebServiceProducts_Client(
            'AWS_ACCESS_KEY_ID',
            'AWS_SECRET_ACCESS_KEY',
            'APPLICATION_NAME',
            'APPLICATION_VERSION',
            $config
        );


        /************************************************************************
         * Uncomment to try out Mock Service that simulates MarketplaceWebServiceProducts
         * responses without calling MarketplaceWebServiceProducts service.
         *
         * Responses are loaded from local XML files. You can tweak XML files to
         * experiment with various outputs during development
         *
         * XML files available under MarketplaceWebServiceProducts/Mock tree
         *
         ***********************************************************************/
        $service = new \MarketplaceWebServiceProducts_Mock();

        /************************************************************************
         * Setup request parameters and uncomment invoke to try out
         * sample for Get Lowest Priced Offers For ASIN Action
         ***********************************************************************/
        // @TODO: set request. Action can be passed as MarketplaceWebServiceProducts_Model_GetLowestPricedOffersForASIN
        $request = new \MarketplaceWebServiceProducts_Model_GetLowestPricedOffersForASINRequest();

        $request->setSellerId('MERCHANT_ID');
        // object or array of parameters
        $this->invokeGetLowestPricedOffersForASIN($service, $request);
    }

    /**
     * Get Get Lowest Priced Offers For ASIN Action Sample
     * Gets competitive pricing and related information for a product identified by
     * the MarketplaceId and ASIN.
     *
     * @param \MarketplaceWebServiceProducts_Interface $service instance of MarketplaceWebServiceProducts_Interface
     * @param mixed                                    $request MarketplaceWebServiceProducts_Model_GetLowestPricedOffersForASIN or array of parameters
     */
    public function invokeGetLowestPricedOffersForASIN(\MarketplaceWebServiceProducts_Interface $service, $request)
    {
        try {
            $response = $service->GetLowestPricedOffersForASIN($request);

            echo("Service Response\n");
            echo("=============================================================================\n");

            $xml = new \SimpleXMLElement($response->toXML());
            dump($xml);

            //            $dom = new \DOMDocument();
            //            $dom->loadXML($response->toXML());
            //            $dom->preserveWhiteSpace = false;
            //            $dom->formatOutput = true;
            //            echo $dom->saveXML();
            //            echo("ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "\n");
        } catch (\MarketplaceWebServiceProducts_Exception $ex) {
            echo("Caught Exception: " . $ex->getMessage() . "\n");
            echo("Response Status Code: " . $ex->getStatusCode() . "\n");
            echo("Error Code: " . $ex->getErrorCode() . "\n");
            echo("Error Type: " . $ex->getErrorType() . "\n");
            echo("Request ID: " . $ex->getRequestId() . "\n");
            echo("XML: " . $ex->getXML() . "\n");
            echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
        }
    }
}
