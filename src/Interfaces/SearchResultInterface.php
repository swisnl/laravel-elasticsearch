<?php

namespace Swis\Elastic\Interfaces;

interface SearchResultInterface
{
    public static function fromElasticSearchResult(array $values): self;
}
