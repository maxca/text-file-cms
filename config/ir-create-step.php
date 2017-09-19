<?php
return [
    [
        'name' => 'step',
        'label' => 'step',
        'id' => 'step',
        'type' => 'number',
        'required' => 'required',
        'placeholder' => 'please insert step',
    ], [
        'name' => 'person',
        'label' => 'type',
        'id' => 'person',
        'type' => 'disable',
        'required' => 'required',
        'placeholder' => 'please insert person',
    ], [
        'name' => 'type',
        'label' => 'action',
        'id' => 'type',
        'type' => 'select',
        'required' => 'required',
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
        'type' => 'number',
        'required' => 'required',
        'placeholder' => 'please insert credit limit',
    ], [
        'name' => 'person',
        // 'label' => 'type',
        'id' => 'person_hid',
        'type' => 'hidden',
        'required' => 'required',
        'placeholder' => 'please insert person',
    ],
];
