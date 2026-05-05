<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have a
    | conventional place to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    /*
    | Camb.ai streaming TTS (https://client.camb.ai/apis/tts-stream)
    | Set CAMB_API_KEY. Optional: voice_id, language, speech_model from Studio / list-voices.
    */
    'camb' => [
        'api_key' => env('CAMB_API_KEY'),
        'api_url' => env('CAMB_API_URL', 'https://client.camb.ai/apis'),
        'voice_id' => (int) env('CAMB_VOICE_ID', 147320),
        'language' => env('CAMB_TTS_LANGUAGE', 'km-kh'),
        'speech_model' => env('CAMB_TTS_MODEL', 'mars-8.1-flash-beta'),
        'format' => env('CAMB_TTS_FORMAT', 'mp3'),
        'timeout' => (int) env('CAMB_TTS_TIMEOUT', 120),
    ],

];
