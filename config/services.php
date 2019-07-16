<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_KEY', '299811867565815'),
        'client_secret' => env('FACEBOOK_SECRET', 'b6910f193022e4f789db8908478f85e8'),
        'redirect' => env('FACEBOOK_REDIRECT_URI', '/')
    ],

    'instagram' => [
        'client_id' => env('INSTAGRAM_KEY', '8b54a135420747b486ff896061edd854'),
        'client_secret' => env('INSTAGRAM_SECRET', 'ca2c0d72387741cc9842f95301708c07'),
        'redirect' => env('INSTAGRAM_REDIRECT_URI', '/')
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => '/',
    ],


    'vkontakte' => [
        'client_id' => env('VKONTAKTE_KEY', '7027895'),
        'client_secret' => env('VKONTAKTE_SECRET', '4da1d1404da1d1404da1d140234dcaedf744da14da1d14010aaaf8bf4b655cd3152d6d4'),
        'redirect' => '/'
    ],

];
