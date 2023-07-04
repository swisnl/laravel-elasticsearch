<?php

declare(strict_types=1);

namespace Swis\Laravel\Elastic\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Swis\Laravel\Elastic\Interfaces\DocumentInterface;
use Swis\Laravel\Elastic\Interfaces\IndexableInterface;
use Swis\Laravel\Elastic\Jobs\Elastic\DeleteDocument;
use Swis\Laravel\Elastic\Jobs\Elastic\IndexDocument;

trait SyncsWithIndex
{
    protected static function bootSyncsWithIndex(): void
    {
        if (!config('elastic.enabled')) {
            return;
        }

        self::deleted(function (IndexableInterface&Model $model) {
            DeleteDocument::dispatch($model->getKey());
        });

        self::saved(function (IndexableInterface&Model $model) {
            $model->index();
        });
    }

    protected function getBaseDocument(): DocumentInterface
    {
        return app(DocumentInterface::class)
            ->setId($this->getKey())
            ->setType($this->getMorphClass())
            ->setDate($this->{$this->getCreatedAtColumn()});
    }

    public function index(): void
    {
        foreach ($this->relatedModelsToIndex() as $relatedModelToIndex) {
            if ($relatedModelToIndex instanceof IndexableInterface && $relatedModelToIndex instanceof Model) {
                $relatedModelToIndex->refresh();
                $relatedModelToIndex->index();
            }
        }

        if ($this->shouldBeIndexed()) {
            IndexDocument::dispatch($this);
        } else {
            DeleteDocument::dispatch($this->getKey());
        }
    }

    public function relatedModelsToIndex(): Collection
    {
        return new Collection();
    }
}
