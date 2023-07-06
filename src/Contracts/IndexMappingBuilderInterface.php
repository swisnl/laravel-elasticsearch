<?php

declare(strict_types=1);

namespace Swis\Laravel\Elasticsearch\Contracts;

interface IndexMappingBuilderInterface
{
    public function indexMapping(): array;
}
