<?php

return [
    'host' => env('ELASTIC_HOST', 'localhost:9200'),
    'index' => env('ELASTIC_INDEX', 'index'),
    'enabled' => env('ELASTIC_ENABLED', false),
    'models' => [
        // define your model classes here that needs to be indexed
    ],
    'index_mapping' => [
        // define your index mapping here
    ],
];
