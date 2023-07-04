<?php

declare(strict_types=1);

namespace Swis\Laravel\ElasticSearch\Interfaces;

interface IndexMappingBuilderInterface
{
    public function buildIndexMappingUsing(): array;
}
