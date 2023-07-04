<?php

declare(strict_types=1);

namespace Swis\Elastic\Interfaces;

interface IndexMappingBuilderInterface
{
    public function buildIndexMappingUsing(): array;
}
