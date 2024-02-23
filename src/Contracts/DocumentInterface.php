<?php

declare(strict_types=1);

namespace Swis\Laravel\Elasticsearch\Contracts;

use Illuminate\Support\Carbon;

interface DocumentInterface
{
    public function setId(string $id): static;

    public function setType(string $type): static;

    public function setDate(Carbon $date): static;

    /**
     * @return array<array-key, mixed>
     */
    public function toArray(): array;
}
