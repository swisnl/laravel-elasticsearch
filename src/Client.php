<?php

declare(strict_types=1);

namespace Swis\Laravel\Elasticsearch;

use Elastic\Elasticsearch\Client as ElasticsearchClient;
use Elastic\Elasticsearch\Response\Elasticsearch;
use Illuminate\Support\Collection;
use Swis\Laravel\Elasticsearch\Interfaces\SearchResultInterface;

class Client
{
    public function __construct(private readonly ElasticsearchClient $elasticSearchClient)
    {
    }

    /**
     * @param array<string,mixed> $query
     */
    public function search(array $query): Elasticsearch
    {
        return $this->elasticSearchClient->search($query);
    }

    /**
     * @param Elasticsearch $searchResultsResponse
     *
     * @return Collection<array-key, SearchResult|SearchResultInterface>
     */
    public function createCollectionResponse(Elasticsearch $searchResultsResponse): Collection
    {
        $searchResults = $searchResultsResponse->asArray();

        $hits = new Collection($searchResults['hits']['hits']);

        if (!app()->bound(SearchResultInterface::class)) {
            /* @phpstan-ignore-next-line */
            return $hits->map(
                static fn (array $document): SearchResult => SearchResult::fromElasticsearchResult($document)
            );
        }

        return $hits->map(
            static fn (array $document): SearchResultInterface => app(SearchResultInterface::class)::fromElasticsearchResult($document)
        );
    }
}
