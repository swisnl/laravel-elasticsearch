<?php

declare(strict_types=1);

namespace Swis\Laravel\Elasticsearch\Contracts;

interface SearchResultInterface
{
    /**
     * @param  array<string, mixed>  $values
     */
    public static function fromElasticsearchResult(array $values): self;
}
