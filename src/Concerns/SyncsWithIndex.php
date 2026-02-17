<?php

declare(strict_types=1);

namespace Swis\Laravel\Elasticsearch\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Swis\Laravel\Elasticsearch\Contracts\DocumentInterface;
use Swis\Laravel\Elasticsearch\Contracts\IndexableInterface;

/**
 * @phpstan-require-extends \Illuminate\Database\Eloquent\Model
 *
 * @phpstan-require-implements \Swis\Laravel\Elasticsearch\Contracts\IndexableInterface
 *
 * @phpstan-ignore trait.unused
 */
trait SyncsWithIndex
{
    protected static function bootSyncsWithIndex(): void
    {
        if (! config('elasticsearch.enabled')) {
            return;
        }

        self::deleted(function (IndexableInterface&Model $model) {
            $model->unindex();
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
            $jobClass = config('elasticsearch.jobs.index_document');
            dispatch(new $jobClass($this));
        } else {
            $this->unindex();
        }
    }

    public function unindex(): void
    {
        $jobClass = config('elasticsearch.jobs.delete_document');
        dispatch(new $jobClass($this->getKey()));
    }

    public function relatedModelsToIndex(): Collection
    {
        return new Collection;
    }
}
