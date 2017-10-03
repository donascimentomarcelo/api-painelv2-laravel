<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        // 'domain' => env('sandboxaab701623ed0400ebe3a04d4e9e9667b.mailgun.org'),
        // 'secret' => env('key-1b9ec2bdcba5c29cd7dd0eceae5aaf8c'),
        'domain' => env('http://marceloprogrammer.com'),
        'secret' => env('key-1b9ec2bdcba5c29cd7dd0eceae5aaf8c'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => Painel\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

];
