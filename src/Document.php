<?php

declare(strict_types=1);

namespace Swis\Laravel\Elasticsearch;

use Illuminate\Support\Carbon;
use Swis\Laravel\Elasticsearch\Contracts\DocumentInterface;

class Document implements DocumentInterface
{
    protected string $id;

    protected string $type;

    protected Carbon $date;

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function setDate(Carbon $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'date' => $this->date->timestamp,
        ];
    }
}
