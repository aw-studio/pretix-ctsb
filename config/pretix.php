<?php

return [

    'api' => [
        'url'   => env('PRETIX_ORDER_API_URL'),
        'token' => env('PRETIX_SECRET'),
    ],

    'configs' => [
        [
            'organizers' => 'ctsb',
            'event'      => 'mobil4',
            'item'       => 120790,
            'subevent'   => 2701127,
            'tax_rule'   => 29737,
            'questions'  => [
                [

                    [
                        'question'            => 28002,
                        'question_identifier' => 'street-no',
                        'type'                => 'Text',
                    ],
                    [
                        'question'            => 28003,
                        'question_identifier' => 'zip-city',
                        'type'                => 'Text',
                    ],
                    [
                        'question'            => 28004,
                        'question_identifier' => 'birthdate',
                        'type'                => 'Date',
                    ],
                    [
                        'question'            => 28005,
                        'question_identifier' => 'phone',
                        'type'                => 'Text',
                    ],
                    [
                        'question'            => 31085,
                        'question_identifier' => 'consent',
                        'type'                => 'Boolean',
                    ],
                    [
                        'question'            => 31098,
                        'question_identifier' => 'consent-cwa-pseudo',
                        'type'                => 'Boolean',
                    ],
                    [
                        'question'            => 31111,
                        'question_identifier' => 'consent-cwa-name',
                        'type'                => 'Boolean',
                    ],
                ],
            ],
        ],
    ],
];
