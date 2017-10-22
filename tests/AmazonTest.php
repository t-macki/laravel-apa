<?php

namespace Macki\tests;

use PHPUnit\Framework\TestCase;

use ApaiIO\ApaiIO;
use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Request\GuzzleRequest;
use ApaiIO\ResponseTransformer\XmlToArray;
use ApaiIO\Operations\Search;

use Macki\AmazonProductApiClient;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class AmazonTest extends TestCase
{
    /**
     * @var AmazonProductApiClient
     */
    protected $amazon;

    public function setUp()
    {
        parent::setUp();
    }

    public function testAmazonInstance()
    {
        $this->setClientHandler('test');
        $this->assertInstanceOf('Macki\AmazonProductApiClient', $this->amazon);
    }

    public function testRun()
    {
        $this->setClientHandler(file_get_contents(__DIR__ . '/stubs/ItemSearch.xml'));

        $search = new Search();

        $search->setCategory('All');
        $search->setKeywords('amazon');
        $search->setResponseGroup(['Large']);

        $response = $this->amazon->run($search);

        $this->assertArrayHasKey('Items', $response);
    }

    public function testBrowse()
    {
        $this->setClientHandler(file_get_contents(__DIR__ . '/stubs/BrowseNodeLookup.xml'));

        $response = $this->amazon->browse('1');

        $this->assertArrayHasKey('BrowseNodes', $response);
    }

    public function testItem()
    {
        $this->setClientHandler(file_get_contents(__DIR__ . '/stubs/ItemLookup.xml'));

        $response = $this->amazon->item('1');

        $this->assertArrayHasKey('Items', $response);
    }

    public function testSearch()
    {
        $this->setClientHandler(file_get_contents(__DIR__ . '/stubs/ItemSearch.xml'));

        $response = $this->amazon->search('All', 'keyword');

        $this->assertArrayHasKey('Items', $response);
    }

    /**
     * @param string $body
     */
    private function setClientHandler(string $body)
    {
        $mock = new MockHandler([
            new Response(200, [], $body),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $request = new GuzzleRequest($client);
        $conf = new GenericConfiguration();

        $conf->setResponseTransformer(new XmlToArray())
            ->setRequest($request);

        $apaiio = new ApaiIO($conf);

        $this->amazon = new AmazonProductApiClient($apaiio);
    }
}
