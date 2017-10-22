<?php

namespace Macki;

use ApaiIO\ApaiIO;

use ApaiIO\Operations\OperationInterface;

use ApaiIO\Operations\Search;
use ApaiIO\Operations\Lookup;
use ApaiIO\Operations\BrowseNodeLookup;

class AmazonProductApiClient
{
    /**
     * @var ApaiIO
     */
    protected $api;

    /**
     * AmazonProductApiClient constructor.
     * @param ApaiIO $api
     */
    public function __construct(ApaiIO $api)
    {
        $this->api = $api;
    }

    /**
     * @param ApaiIO $api
     */
    public function config(ApaiIO $api)
    {
        $this->api = $api;
    }

    /**
     * runOperation
     * @param OperationInterface $operation
     * @return mixed
     */
    public function run(OperationInterface $operation)
    {
        $result = $this->api->runOperation($operation);

        return $result;
    }

    /**
     * ItemSearch
     *
     * @param string $category
     * @param string|null $keyword
     * @param int $browseNodeId
     * @param int $page
     * @param array $responseGroup
     * @param string $sort
     * @return mixed
     */
    public function search(
        string $category = 'All',
        string $keyword = null,
        int $browseNodeId = -1,
        string $sort = null,
        int $page = 1,
        array $responseGroup = ['Large']
    ) {
        $search = new Search();

        $search->setCategory($category);
        $search->setKeywords($keyword);
        if ($browseNodeId) {
            $search->setBrowseNode($browseNodeId);
        }
        if ($sort) {
            $search->setSort($sort);
        }
        if ($page > 0) {
            $search->setPage($page);
        }
        $search->setResponseGroup($responseGroup);

        return $this->run($search);
    }

    /**
     * BrowseNodeLookup
     *
     * @param string $node
     * @param array $response
     * @return mixed
     */
    public function browse(string $node, array $response = ['TopSellers'])
    {
        $browse = new BrowseNodeLookup();

        $browse->setNodeId($node);
        $browse->setResponseGroup($response);

        return $this->run($browse);
    }

    /**
     * ItemLookup
     *
     * @param string $itemId
     * @param array $responseGroup
     * @return mixed
     */
    public function item(string $itemId, array $responseGroup = ['Large'])
    {
        $lookup = new Lookup();

        $lookup->setItemId($itemId);
        $lookup->setResponseGroup($responseGroup);

        return $this->run($lookup);
    }
}
