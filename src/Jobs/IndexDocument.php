<?php

declare(strict_types=1);

namespace Swis\Laravel\ElasticSearch\Jobs;

use Elastic\Elasticsearch\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Swis\Laravel\ElasticSearch\Interfaces\IndexableInterface;

class IndexDocument implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(protected IndexableInterface $model)
    {
    }

    public function handle(Client $client): void
    {
        $data = $this->model->getElasticDocument()->toArray();

        $client->index([
            'index' => config('elasticsearch.index'),
            'id' => $data['id'],
            'body' => $data,
        ]);
    }
}
