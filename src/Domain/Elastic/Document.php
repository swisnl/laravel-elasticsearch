<?php

declare(strict_types=1);

namespace Swis\Elastic\Domain\Elastic;

use Illuminate\Support\Carbon;
use Swis\Elastic\Interfaces\DocumentInterface;

class Document implements DocumentInterface
{
    protected string $id;
    protected string $type;
    protected Carbon $date;

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setDate(Carbon $date): self
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
