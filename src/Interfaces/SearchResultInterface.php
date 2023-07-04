<?php

declare(strict_types=1);

namespace Swis\Laravel\Elastic\Interfaces;

interface SearchResultInterface
{
    public static function fromElasticSearchResult(array $values): self;
}
