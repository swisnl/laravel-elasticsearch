<?php

declare(strict_types=1);

namespace Swis\Laravel\Elasticsearch\Jobs;

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
        /** @var string $index */
        $index = config('elasticsearch.index');

        try {
            $client->delete([
                'index' => $index,
                'id' => $this->id,
            ]);
        } catch (ClientResponseException $exception) {
            if ($exception->getCode() !== 404) {
                throw $exception;
            }
        }
    }
}
