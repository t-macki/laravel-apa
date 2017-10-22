<?php
namespace Macki\Factory;

use ApaiIO\ApaiIO;
use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Request\GuzzleRequest;
use GuzzleHttp\Client;
use Macki\AmazonProductApiClient;

class AmazonProductApiFactory
{
    /**
     * @param array $config
     * @return AmazonProductApiClient
     */
    public static function createForConfig(array $config): AmazonProductApiClient
    {
        $conf = new GenericConfiguration();
        $client = new Client();

        $request = new GuzzleRequest($client);
        $request->setScheme('https');

        $conf->setCountry($config['amazon_product_country'])
            ->setAccessKey($config['amazon_product_api_key'])
            ->setSecretKey($config['amazon_product_api_secret_key'])
            ->setAssociateTag($config['amazon_associate_tag'])
            ->setRequest($request);

        $apaiio = new ApaiIO($conf);

        return new AmazonProductApiClient($apaiio);
    }
}