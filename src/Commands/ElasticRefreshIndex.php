<?php

namespace Swis\Elastic\Commands;

use Swis\Elastic\Interfaces\IndexableInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class ElasticRefreshIndex extends Command
{
    protected $signature = 'elastic:refresh-index';

    protected $description = 'Refreshes the index in elastic';

    public function handle(): int
    {
        $this->call('elastic:delete-index');
        $this->call('elastic:create-index');

        /** @var class-string<\Illuminate\Database\Eloquent\Model>[] $models */
        $models = config('elastic.models');

        $models = collect($models)
            ->filter(fn (string $model) => is_a($model, IndexableInterface::class, true))
            ->flatMap(fn (string $model): Collection => $model::all())
            ->each(fn (IndexableInterface $model) => $model->index());

        $this->info(sprintf('Dispatched %d index jobs', $models->count()));

        return Command::SUCCESS;
    }
}
