<?php

declare(strict_types=1);

namespace Swis\Laravel\Elasticsearch\Commands;

use Elastic\Elasticsearch\Client;
use Illuminate\Console\Command;
use Swis\Laravel\Elasticsearch\Interfaces\IndexMappingBuilderInterface;

class ElasticsearchCreateIndex extends Command
{
    protected $signature = 'elasticsearch:create-index {--index= : index that needs to be created (index from config is used if option is omitted)}';

    protected $description = 'Creates index in elasticsearch';

    public function getConfigBuilderClass(): array
    {
        return app()->bound(IndexMappingBuilderInterface::class) ?
            app(IndexMappingBuilderInterface::class)->buildIndexMappingUsing() :
            config('elasticsearch.index_mapping');
    }

    public function handle(Client $client): int
    {
        $index = $this->option('index') ?? config('elasticsearch.index');

        $client->indices()->create([
            'index' => $index,
            'body' => $this->getConfigBuilderClass(),
        ]);

        $this->info(sprintf('Index "%s" created', $index));

        return Command::SUCCESS;
    }
}
