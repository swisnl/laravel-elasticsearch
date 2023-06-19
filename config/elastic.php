<?php

return [
    'host' => env('ELASTIC_HOST', 'localhost:9200'),
    'index' => env('ELASTIC_INDEX', 'index'),
    'enabled' => env('ELASTIC_ENABLED', false),
    'models' => [
        // define your model classes here that needs to be indexed
    ],
    'index_mapping' => [
        'settings' => [
            'analysis' => [
                'filter' => [
                    'stop_nl' => [
                        'type' => 'stop',
                        'stopwords' => '_dutch_',
                    ],
                    'snow_nl' => [
                        'type' => 'snowball',
                        'language' => 'Dutch',
                    ],
                    'length_nl' => [
                        'type' => 'length',
                        'min' => 3,
                    ],
                    'decompounder_nl' => [
                        'type' => 'dictionary_decompounder',
                        'word_list_path' => 'vendor/swisnl/laravel-elastic/config/analysis/nl_NL/wordList.txt',
                    ],
                ],
                'analyzer' => [
                    'default' => [
                        'tokenizer' => 'standard',
                        'filter' => [
                            'lowercase',
                            'decompounder_nl',
                            'length_nl',
                            'stop_nl',
                            'snow_nl',
                        ],
                    ],
                    'default_search' => [
                        'tokenizer' => 'standard',
                        'filter' => [
                            'lowercase',
                            'decompounder_nl',
                            'length_nl',
                            'stop_nl',
                            'snow_nl',
                        ],
                    ],
                ],
            ],
        ],
        'mappings' => [
            'properties' => [
                'type' => ['type' => 'keyword'],
            ],
        ],
    ],
];
