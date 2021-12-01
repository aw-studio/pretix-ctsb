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
                        'question'            => 28002,
                        'question_identifier' => 'street-no',
                    ],
                    [
                        'question'            => 28003,
                        'question_identifier' => 'zip-city',
                    ],
                    [
                        'question'            => 28004,
                        'question_identifier' => 'birthdate',
                    ],
                    [
                        'question'            => 28005,
                        'question_identifier' => 'phone',
                    ],
                    [
                        'question'            => 28006,
                        'question_identifier' => 'pass-id',
                    ],
                    [
                        'question'            => 31085,
                        'question_identifier' => 'consent',
                        'value'               => 'False',
                    ],
                    [
                        'question'            => 31098,
                        'question_identifier' => 'consent-cwa-pseudo',
                        'value'               => 'False',
                    ],
                    [
                        'question'            => 31111,
                        'question_identifier' => 'consent-cwa-name',
                        'value'               => 'False',
                    ],
            ],
        ],
    ],
];
