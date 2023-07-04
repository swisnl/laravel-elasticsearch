<?php

declare(strict_types=1);

namespace Swis\Laravel\Elastic\Interfaces;

interface IndexMappingBuilderInterface
{
    public function buildIndexMappingUsing(): array;
}
