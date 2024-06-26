<?php

return [
    'mercant_id' => env('MIDTRANS_MERCHAT_ID'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'server_key' => env('MIDTRANS_SERVER_KEY'),

    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => false,
    'is_3ds' => false,
    'snap_url' => env('MIDTRANS_SNAP_URL'),
    'is_active' => env('MIDTRANS_ACTIVE', true),
    'template_1' => env('MIDTRANS_TEMPLATE_1', 10000),
    'template_2' => env('MIDTRANS_TEMPLATE_2', 10000),
];

