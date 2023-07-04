<?php

declare(strict_types=1);

namespace Swis\Laravel\Elasticsearch\Interfaces;

interface IndexMappingBuilderInterface
{
    public function buildIndexMappingUsing(): array;
}
