<?php

declare(strict_types=1);

namespace Swis\Laravel\ElasticSearch\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Swis\Laravel\ElasticSearch\Interfaces\DocumentInterface;
use Swis\Laravel\ElasticSearch\Interfaces\IndexableInterface;
use Swis\Laravel\ElasticSearch\Jobs\DeleteDocument;
use Swis\Laravel\ElasticSearch\Jobs\IndexDocument;

trait SyncsWithIndex
{
    protected static function bootSyncsWithIndex(): void
    {
        if (!config('elasticsearch.enabled')) {
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
