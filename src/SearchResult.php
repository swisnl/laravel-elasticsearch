<?php

declare(strict_types=1);

namespace Swis\Laravel\Elasticsearch;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Carbon;
use Swis\Laravel\Elasticsearch\Contracts\SearchResultInterface;

/** @phpstan-ignore-next-line */
class SearchResult implements Arrayable, SearchResultInterface
{
    protected string $id;
    protected string $type;
    protected Carbon $date;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
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

    public function getDate(): Carbon
    {
        return $this->date;
    }

    /**
     * @param array<string, mixed> $values
     */
    public static function fromElasticsearchResult(array $values): self
    {
        return (new self())
            ->setId($values['_source']['id'])
            ->setType($values['_source']['type'])
            ->setDate(Carbon::parse($values['_source']['date']));
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'type' => $this->getType(),
            'date' => $this->getDate()->format('d-m-Y'),
        ];
    }
}
