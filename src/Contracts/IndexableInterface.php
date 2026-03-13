<?php

declare(strict_types=1);

namespace Swis\Laravel\Elasticsearch\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Swis\Laravel\Elasticsearch\Document;

interface IndexableInterface
{
    public function getElasticDocument(): Document;

    public function shouldBeIndexed(): bool;

    /**
     * @return Collection<int,Model>
     */
    public function relatedModelsToIndex(): Collection;

    public function index(): void;

    public function unindex(): void;
}
