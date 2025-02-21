<?php

return [
    'host' => env('ELASTICSEARCH_HOST', 'localhost:9200'),
    'username' => env('ELASTICSEARCH_USERNAME'),
    'password' => env('ELASTICSEARCH_PASSWORD'),
    'index' => env('ELASTICSEARCH_INDEX', 'index'),
    'enabled' => env('ELASTICSEARCH_ENABLED', false),
    'models' => [
        // define your model classes here that needs to be indexed
    ],
    'search_fields' => [
        // define the fields that needs to be searched with additional boosting example: 'title^5'
    ],
    'index_mapping' => [
        'mappings' => [
            'properties' => [
                'type' => ['type' => 'keyword'],
                'date' => ['type' => 'date', 'format' => 'epoch_second'],
            ],
        ],
    ],
];
