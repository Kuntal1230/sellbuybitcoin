<?php

return [
    'user' => [
        'model' => 'App\User',
    ],
    'broadcast' => [
        'enable' => true,
        'app_name' => 'bitcoinchat',
        'pusher' => [
            'app_id' => '534307',
            'app_key' => '1b47bb65c6ef8aacd9fc',
            'app_secret' => '00a86bfc3f63c24de1c0',
            'options' => [
                'cluster' => 'ap2',
                'encrypted' => true
            ]
        ],
    ],
];
