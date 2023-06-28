<?php

declare(strict_types=1);

namespace Swis\Elastic\Interfaces;

use Illuminate\Support\Carbon;

interface DocumentInterface
{
    public function setId(string $id): self;

    public function setType(string $type): self;

    public function setDate(Carbon $date): self;

    /**
     * @return array<array-key, mixed>
     */
    public function toArray(): array;
}
