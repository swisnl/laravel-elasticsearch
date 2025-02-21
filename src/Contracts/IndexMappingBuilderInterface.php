<?php

declare(strict_types=1);

namespace Swis\Laravel\Elasticsearch\Contracts;

interface IndexMappingBuilderInterface
{
    /**
     * @return array<string, mixed>
     */
    public function indexMapping(): array;
}
