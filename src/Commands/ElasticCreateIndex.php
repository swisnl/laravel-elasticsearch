<?php

declare(strict_types=1);

namespace Swis\Laravel\ElasticSearch\Commands;

use Elastic\Elasticsearch\Client;
use Illuminate\Console\Command;
use Swis\Laravel\ElasticSearch\Interfaces\IndexMappingBuilderInterface;

class ElasticCreateIndex extends Command
{
    protected $signature = 'elastic:create-index {--index= : index that needs to be created (index from config is used if option is omitted)}';

    protected $description = 'Creates index in elasticsearch';

    public function getConfigBuilderClass(): array
    {
        return app()->bound(IndexMappingBuilderInterface::class) ?
            app(IndexMappingBuilderInterface::class)->buildIndexMappingUsing() :
            config('elastic.index_mapping');
    }

    public function handle(Client $client): int
    {
        $index = $this->option('index') ?? config('elastic.index');

        $client->indices()->create([
            'index' => $index,
            'body' => $this->getConfigBuilderClass(),
        ]);

        $this->info(sprintf('Index "%s" created', $index));

        return Command::SUCCESS;
    }
}
