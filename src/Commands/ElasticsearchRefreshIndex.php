<?php

declare(strict_types=1);

namespace Swis\Laravel\Elasticsearch\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Swis\Laravel\Elasticsearch\Contracts\IndexableInterface;

/**
 * @phpstan-type IndexableModel \Illuminate\Database\Eloquent\Model&\Swis\Laravel\Elasticsearch\Contracts\IndexableInterface
 */
class ElasticsearchRefreshIndex extends Command
{
    protected $signature = 'elasticsearch:refresh-index';

    protected $description = 'Refreshes the index in elastic';

    public function handle(): int
    {
        $this->call(ElasticsearchDeleteIndex::class);
        $this->call(ElasticsearchCreateIndex::class);

        /** @var class-string<IndexableModel>[] $models */
        $models = config('elasticsearch.models');

        $models = collect($models)
            ->filter(fn (string $model): bool => is_a($model, Model::class, true) && is_a($model, IndexableInterface::class, true))
            /**
             * @param  class-string<IndexableModel>  $model
             * @return array<int, IndexableModel>
             */
            ->flatMap(fn (string $model): array => $model::all()->all())
            ->each(fn (IndexableInterface $model) => $model->index());

        $this->info(sprintf('Dispatched %d index jobs', $models->count()));

        return self::SUCCESS;
    }
}
