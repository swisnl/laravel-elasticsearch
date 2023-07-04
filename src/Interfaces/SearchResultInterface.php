<?php

declare(strict_types=1);

namespace Swis\Laravel\Elasticsearch\Interfaces;

interface SearchResultInterface
{
    public static function fromElasticsearchResult(array $values): self;
}
