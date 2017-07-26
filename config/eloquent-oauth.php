<?php

use App\User;

return [
    'model' => User::class,
    'table' => 'oauth_identities',
    'providers' => [
        'facebook' => [
            'client_id' => '1737546833204636',
            'client_secret' => 'a7e70841e3e0ecc11b7966704b887f5b',
            'redirect_uri' => 'http://rheedforum.herokuapp.com/facebook/redirect',
            'scope' => [],
        ],
        'google' => [
            'client_id' => '503301328328-ie9345fsv66j71bi5hklp0or84ljg5kj.apps.googleusercontent.com',
            'client_secret' => 'EjUFIurJfUExh6UXD0p6Rd_a',
            'redirect_uri' => 'https://rheedforum.herokuapp.com/forum',
            'scope' => [],
        ],
        'github' => [
            'client_id' => 'ad227750608019a1d2ca',
            'client_secret' => 'b0caa49c2d22feb0216953cf3b8a079da178bc52',
            'redirect_uri' => 'http://127.0.0.1:8000/github/redirect',
            'scope' => [],
        ],
        'linkedin' => [
            'client_id' => '12345678',
            'client_secret' => 'y0ur53cr374ppk3y',
            'redirect_uri' => 'https://example.com/your/linkedin/redirect',
            'scope' => [],
        ],
        'instagram' => [
            'client_id' => '12345678',
            'client_secret' => 'y0ur53cr374ppk3y',
            'redirect_uri' => 'https://example.com/your/instagram/redirect',
            'scope' => [],
        ],
        'soundcloud' => [
            'client_id' => '12345678',
            'client_secret' => 'y0ur53cr374ppk3y',
            'redirect_uri' => 'https://example.com/your/soundcloud/redirect',
            'scope' => [],
        ],
    ],
];
