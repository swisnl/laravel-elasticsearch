<?php

return [
    /*
     * The host and credentials of your Elasticsearch server.
     */
    'host' => env('ELASTICSEARCH_HOST', 'localhost:9200'),
    'username' => env('ELASTICSEARCH_USERNAME'),
    'password' => env('ELASTICSEARCH_PASSWORD'),

    /*
     * The name of the index that will be used to store your models.
     */
    'index' => env('ELASTICSEARCH_INDEX', 'index'),

    /*
     * Set this to true to enable automatic indexing of your models. You can also set
     * this to false and call the index() method on your models manually.
     */
    'enabled' => env('ELASTICSEARCH_ENABLED', false),

    /*
     * Here you can define your model classes that need to be indexed. This is used when
     * using the artisan commands to reindex your models.
     */
    'models' => [
        // Example: App\Models\Post::class,
    ],

    /*
     * Here you can override the class names of the jobs used by this package. Make sure
     * your custom jobs extend the ones provided by the package.
     */
    'jobs' => [
        'index_document' => Swis\Laravel\Elasticsearch\Jobs\IndexDocument::class,
        'delete_document' => Swis\Laravel\Elasticsearch\Jobs\DeleteDocument::class,
    ],

    /*
     * Here you can define the fields that need to be searched with additional boosting.
     */
    'search_fields' => [
        // Example: 'title^5',
    ],

    /*
     * Here you can define the mapping of your index. This is used when creating the index
     * and should be defined according to the Elasticsearch mapping specifications.
     * Alternatively you can create a custom IndexMappingBuilderInterface implementation
     * and bind it in the service container to generate the mapping dynamically.
     */
    'index_mapping' => [
        'mappings' => [
            'properties' => [
                'type' => ['type' => 'keyword'],
                'date' => ['type' => 'date', 'format' => 'epoch_second'],
            ],
        ],
    ],
];
