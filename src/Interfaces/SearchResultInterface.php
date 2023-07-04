<?php

declare(strict_types=1);

namespace Swis\Laravel\ElasticSearch\Interfaces;

interface SearchResultInterface
{
    public static function fromElasticSearchResult(array $values): self;
}
