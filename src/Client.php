<?php

namespace Swis\Elastic;

use Elastic\Elasticsearch\Client as ElasticSearchClient;
use Elastic\Elasticsearch\Response\Elasticsearch;
use Illuminate\Support\Collection;
use Swis\Elastic\Domain\Elastic\SearchResult;
use Swis\Elastic\Interfaces\SearchResultInterface;

class Client
{
    public function __construct(private readonly ElasticSearchClient $elasticSearchClient)
    {
    }

    public function search($query): Elasticsearch
    {
        return $this->elasticSearchClient->search($query);
    }

    public function createCollectionResponse(Elasticsearch $searchResultsResponse): Collection
    {
        $searchResults = $searchResultsResponse->asArray();

        /** @var array<string,mixed> $hits */
        $hits = $searchResults['hits']['hits'];

        if(!app()->bound(SearchResultInterface::class)){
            return collect($hits)->map(static fn (array $document) => SearchResult::fromElasticSearchResult($document));
        }

        return collect($hits)->map(static fn (array $document) => app(SearchResultInterface::class)::fromElasticSearchResult($document));
    }
}
