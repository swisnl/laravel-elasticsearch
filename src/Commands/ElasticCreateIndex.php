<?php

declare(strict_types=1);

namespace Swis\Elastic\Commands;

use Elastic\Elasticsearch\Client;
use Illuminate\Console\Command;

class ElasticCreateIndex extends Command
{
    protected $signature = 'elastic:create-index {--index= : index that needs to be created (index from config is used if option is omitted)}';

    protected $description = 'Creates index in elasticsearch';

    public function handle(Client $client): int
    {
        $index = $this->option('index') ?? config('elastic.index');

        $client->indices()->create([
            'index' => $index,
            'body' => config('elastic.index_mapping'),
        ]);

        return Command::SUCCESS;
    }
}
