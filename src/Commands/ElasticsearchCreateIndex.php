<?php

declare(strict_types=1);

namespace Swis\Laravel\Elasticsearch\Commands;

use Elastic\Elasticsearch\Client;
use Illuminate\Console\Command;
use Swis\Laravel\Elasticsearch\Contracts\IndexMappingBuilderInterface;

class ElasticsearchCreateIndex extends Command
{
    protected $signature = 'elasticsearch:create-index {--index= : index that needs to be created (index from config is used if option is omitted)}';

    protected $description = 'Creates index in elasticsearch';

    /**
     * @return array<string, mixed>
     */
    public function getIndexMapping(): array
    {
        return app()->bound(IndexMappingBuilderInterface::class) ?
            app(IndexMappingBuilderInterface::class)->indexMapping() :
            config('elasticsearch.index_mapping');
    }

    public function handle(Client $client): int
    {
        $index = $this->option('index') ?? config('elasticsearch.index');

        $client->indices()->create([
            'index' => $index,
            'body' => $this->getIndexMapping(),
        ]);

        $this->info(sprintf('Index "%s" created', $index));

        return self::SUCCESS;
    }
}
