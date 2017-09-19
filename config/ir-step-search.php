<?php
return [
    [
        'name' => 'step',
        'label' => 'step',
        'id' => 'step',
        'type' => 'text',
        'placeholder' => 'please insert step',
    ], [
        'name' => 'type',
        'label' => 'action',
        'id' => 'action',
        'type' => 'select',
        'placeholder' => 'please insert action',
        'select' => [
            'displayname' => 'select action',
            'list' => [
                'Block' => 'block',
                'Notification' => 'notification',
            ],
        ],
    ], [
        'name' => 'price',
        'label' => 'credit limit',
        'id' => 'price',
        'type' => 'text',
        'placeholder' => 'please insert credit limit',
    ],
];
