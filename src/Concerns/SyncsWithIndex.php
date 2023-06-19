<?php

namespace Swis\Elastic\Concerns;

use Swis\Elastic\Interfaces\IndexableInterface;
use Swis\Elastic\Domain\Elastic\Document;
use Swis\Elastic\Jobs\Elastic\DeleteDocument;
use Swis\Elastic\Jobs\Elastic\IndexDocument;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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

    protected function getBaseDocument(): Document
    {
        return (new Document())
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
