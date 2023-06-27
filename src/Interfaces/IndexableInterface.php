<?php

namespace Swis\Elastic\Interfaces;

use Swis\Elastic\Domain\Elastic\Document;
use Illuminate\Support\Collection;

interface IndexableInterface
{
    public function getElasticDocument(): Document;

    public function shouldBeIndexed(): bool;

    /**
     * @return \Illuminate\Support\Collection<int,\Illuminate\Database\Eloquent\Model>
     */
    public function relatedModelsToIndex(): Collection;

    public function index(): void;
}
