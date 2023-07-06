<?php

declare(strict_types=1);

namespace Swis\Laravel\Elasticsearch\Contracts;

interface SearchResultInterface
{
    public static function fromElasticsearchResult(array $values): self;
}
