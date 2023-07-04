<?php

declare(strict_types=1);

namespace Swis\Laravel\ElasticSearch\Jobs;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteDocument implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private int|string $id;

    public function __construct(int|string $id)
    {
        $this->id = $id;
    }

    public function handle(Client $client): void
    {
        try {
            $client->delete([
                'index' => config('elastic.index'),
                'id' => $this->id,
            ]);
        } catch (ClientResponseException $exception) {
            if ($exception->getCode() !== 404) {
                throw $exception;
            }
        }
    }
}
