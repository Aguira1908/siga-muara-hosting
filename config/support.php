
<?php

return [
    'whatsapp_number' => env('SUPPORT_WHATSAPP_NUMBER', ''),

    'whatsapp_admin' => env('SUPPORT_WHATSAPP_NUMBER', ''),

    'payments' => [
        'transfer_bank' => [
            'label' => 'Transfer Bank BRI',
            'account_number' => '109401020965503',
            'account_name' => 'Fran..Mar..Pan',
            'description' => 'Silakan transfer sesuai nominal dukungan.',
        ],

        'Dana' => [
            'label' => 'DANA',
            'account_number' => '085245160161',
            'account_name' => 'Fran..Mar..Pan',
            'description' => 'Silakan lakukan pembayaran melalui Dana.',
        ],
    ],
];
