<?php
return [
    [
        'name' => 'msisdn',
        'label' => 'msisdn',
        'id' => 'msisdn',
        'type' => 'text',
        'placeholder' => 'please insert msisdn',
    ], [
        'name' => 'operator',
        'label' => 'operator',
        'id' => 'operator',
        'type' => 'select',
        'placeholder' => 'input transaction',
        'select' => [
            'displayname' => 'select operator',
            'list' => [
                '0' => '0',
                '1' => '1',
                '2' => '2',
            ],
        ],

    ], [
        'name' => 'step',
        'label' => 'step',
        'id' => 'step',
        'type' => 'text',
        'placeholder' => 'please insert step',
    ], [
        'name' => 'action',
        'label' => 'action',
        'id' => 'action',
        'type' => 'select',
        'placeholder' => 'input transaction',
        'select' => [
            'displayname' => 'select action',
            'list' => [
                '0' => '0',
                '1' => '1',
            ],
        ],

    ], [
        'name' => 'type',
        'label' => 'type',
        'id' => 'type',
        'type' => 'select',
        'placeholder' => 'input transaction',
        'select' => [
            'displayname' => 'select type',
            'list' => [
                'v' => 'v',
                'n' => 'n',
            ],
        ],

    ], [
        'name' => 'mcc_mnc',
        'label' => 'mcc_mnc',
        'id' => 'mcc_mnc',
        'type' => 'text',
        'placeholder' => 'please insert mcc_mnc',
    ], [
        'name' => 'device',
        'label' => 'device',
        'id' => 'device',
        'type' => 'text',
        'placeholder' => 'please insert device',
    ], [
        'name' => 'browser',
        'label' => 'browser',
        'id' => 'browser',
        'type' => 'text',
        'placeholder' => 'please insert browser',
    ],
    [
        'name' => 'accepted',
        'label' => 'accepted',
        'id' => 'accepted',
        'type' => 'select',
        'placeholder' => 'input transaction',
        'select' => [
            'displayname' => 'select accepted',
            'list' => [
                'YES' => 'Yes',
                'NO' => 'No',
            ],
        ],

    ],
    [
        'name' => 'warning_level',
        'label' => 'Credit Limit',
        'id' => 'warning_level',
        'type' => 'text',
        'placeholder' => 'please insert credit limit',

    ],
    [
        'name' => 'created_at',
        'label' => 'created',
        'id' => 'created_at',
        'type' => 'daterange',
        'placeholder' => 'input created_at',

    ],
];
