<?php

namespace Swis\Elastic\Domain\Elastic;

use Illuminate\Support\Carbon;

class Document
{
    protected string $id;
    protected string $type;
    protected Carbon $date;

    public function setId(string $id): Document
    {
        $this->id = $id;

        return $this;
    }

    public function setType(string $type): Document
    {
        $this->type = $type;

        return $this;
    }


    public function setDate(Carbon $date): Document
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
